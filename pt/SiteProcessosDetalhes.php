<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbProcessos = $_GET["idTbProcessos"];

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Query de pesquisa.
//----------
$strSqlProcessosDetalhesSelect = "";
$strSqlProcessosDetalhesSelect .= "SELECT ";
//$strSqlProcessosDetalhesSelect .= "* ";
$strSqlProcessosDetalhesSelect .= "id, ";
$strSqlProcessosDetalhesSelect .= "id_parent, ";
$strSqlProcessosDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlProcessosDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlProcessosDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlProcessosDetalhesSelect .= "n_classificacao, ";
$strSqlProcessosDetalhesSelect .= "data_criacao, ";
$strSqlProcessosDetalhesSelect .= "data_abertura, ";
$strSqlProcessosDetalhesSelect .= "data_distribuicao, ";
$strSqlProcessosDetalhesSelect .= "data_admissao, ";
$strSqlProcessosDetalhesSelect .= "data_demissao, ";
$strSqlProcessosDetalhesSelect .= "data1, ";
$strSqlProcessosDetalhesSelect .= "data2, ";
$strSqlProcessosDetalhesSelect .= "data3, ";
$strSqlProcessosDetalhesSelect .= "data4, ";
$strSqlProcessosDetalhesSelect .= "data5, ";
$strSqlProcessosDetalhesSelect .= "data6, ";
$strSqlProcessosDetalhesSelect .= "data7, ";
$strSqlProcessosDetalhesSelect .= "data8, ";
$strSqlProcessosDetalhesSelect .= "data9, ";
$strSqlProcessosDetalhesSelect .= "data10, ";
$strSqlProcessosDetalhesSelect .= "processo, ";
$strSqlProcessosDetalhesSelect .= "descricao, ";
$strSqlProcessosDetalhesSelect .= "id_tb_processos_status, ";
$strSqlProcessosDetalhesSelect .= "palavras_chave, ";
$strSqlProcessosDetalhesSelect .= "valor, ";
$strSqlProcessosDetalhesSelect .= "valor1, ";
$strSqlProcessosDetalhesSelect .= "valor2, ";
$strSqlProcessosDetalhesSelect .= "valor3, ";
$strSqlProcessosDetalhesSelect .= "valor4, ";
$strSqlProcessosDetalhesSelect .= "valor5, ";
$strSqlProcessosDetalhesSelect .= "url1, ";
$strSqlProcessosDetalhesSelect .= "url2, ";
$strSqlProcessosDetalhesSelect .= "url3, ";
$strSqlProcessosDetalhesSelect .= "url4, ";
$strSqlProcessosDetalhesSelect .= "url5, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar1, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar2, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar3, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar4, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar5, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar6, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar7, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar8, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar9, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar10, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar11, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar12, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar13, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar14, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar15, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar16, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar17, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar18, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar19, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar20, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar21, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar22, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar23, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar24, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar25, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar26, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar27, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar28, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar29, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar30, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar31, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar32, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar33, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar34, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar35, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar36, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar37, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar38, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar39, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar40, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar41, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar42, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar43, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar44, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar45, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar46, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar47, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar48, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar49, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar50, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar51, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar52, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar53, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar54, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar55, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar56, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar57, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar58, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar59, ";
$strSqlProcessosDetalhesSelect .= "informacao_complementar60, ";
$strSqlProcessosDetalhesSelect .= "ativacao, ";
$strSqlProcessosDetalhesSelect .= "ativacao1, ";
$strSqlProcessosDetalhesSelect .= "ativacao2, ";
$strSqlProcessosDetalhesSelect .= "ativacao3, ";
$strSqlProcessosDetalhesSelect .= "ativacao4, ";
$strSqlProcessosDetalhesSelect .= "n_visitas, ";
$strSqlProcessosDetalhesSelect .= "acesso_restrito ";
$strSqlProcessosDetalhesSelect .= "FROM tb_processos ";
$strSqlProcessosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlProcessosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlProcessosDetalhesSelect .= "AND id = :id ";
//$strSqlProcessosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementProcessosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlProcessosDetalhesSelect);

if ($statementProcessosDetalhesSelect !== false)
{
	$statementProcessosDetalhesSelect->execute(array(
		"id" => $idTbProcessos
	));
}

//$resultadoProcessosDetalhes = $dbSistemaConPDO->query($strSqlProcessosDetalhesSelect);
$resultadoProcessosDetalhes = $statementProcessosDetalhesSelect->fetchAll();

if (empty($resultadoProcessosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoProcessosDetalhes as $linhaProcessosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbProcessosId = $linhaProcessosDetalhes['id'];
		$tbProcessosIdParent = $linhaProcessosDetalhes['id_parent'];
		
		$tbProcessosIdTbCadastro1 = $linhaProcessosDetalhes['id_tb_cadastro1'];
		$tbProcessosIdTbCadastro2 = $linhaProcessosDetalhes['id_tb_cadastro2'];
		$tbProcessosIdTbCadastro3 = $linhaProcessosDetalhes['id_tb_cadastro3'];
		
		$tbProcessosNClassificacao = $linhaProcessosDetalhes['n_classificacao'];
		
		$tbProcessosDataCriacao = Funcoes::DataLeitura01($linhaProcessosDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
		//$tbProcessosDataAbertura = Funcoes::DataLeitura01($linhaProcessosDetalhes['data_abertura'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaProcessosDetalhes['data_abertura'] == NULL)
		{
			$tbProcessosDataAbertura = "";
		}else{
			$tbProcessosDataAbertura = Funcoes::DataLeitura01($linhaProcessosDetalhes['data_abertura'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		if($linhaProcessosDetalhes['data_distribuicao'] == NULL)
		{
			$tbProcessosDataDistribuicao = "";
		}else{
			$tbProcessosDataDistribuicao = Funcoes::DataLeitura01($linhaProcessosDetalhes['data_distribuicao'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data_admissao'] == NULL)
		{
			$tbProcessosDataAdmissao = "";
		}else{
			$tbProcessosDataAdmissao = Funcoes::DataLeitura01($linhaProcessosDetalhes['data_admissao'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data_demissao'] == NULL)
		{
			$tbProcessosDataDemissao = "";
		}else{
			$tbProcessosDataDemissao = Funcoes::DataLeitura01($linhaProcessosDetalhes['data_demissao'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data1'] == NULL)
		{
			$tbProcessosData1 = "";
		}else{
			$tbProcessosData1 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data1'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data2'] == NULL)
		{
			$tbProcessosData2 = "";
		}else{
			$tbProcessosData2 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data2'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data3'] == NULL)
		{
			$tbProcessosData3 = "";
		}else{
			$tbProcessosData3 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data3'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data4'] == NULL)
		{
			$tbProcessosData4 = "";
		}else{
			$tbProcessosData4 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data4'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data5'] == NULL)
		{
			$tbProcessosData5 = "";
		}else{
			$tbProcessosData5 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data5'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data6'] == NULL)
		{
			$tbProcessosData6 = "";
		}else{
			$tbProcessosData6 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data6'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data7'] == NULL)
		{
			$tbProcessosData7 = "";
		}else{
			$tbProcessosData7 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data7'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data8'] == NULL)
		{
			$tbProcessosData8 = "";
		}else{
			$tbProcessosData8 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data8'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data9'] == NULL)
		{
			$tbProcessosData9 = "";
		}else{
			$tbProcessosData9 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data9'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaProcessosDetalhes['data10'] == NULL)
		{
			$tbProcessosData10 = "";
		}else{
			$tbProcessosData10 = Funcoes::DataLeitura01($linhaProcessosDetalhes['data10'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		$tbProcessosProcesso = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['processo']);
		$tbProcessosDescricao = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['descricao']);

		$tbProcessosIdTbProcessosStatus = $linhaProcessosDetalhes['id_tb_processos_status'];
		if($tbProcessosIdTbProcessosStatus <> 0)
		{
			$tbProcessosIdTbProcessosStatusPrint = DbFuncoes::GetCampoGenerico01($tbProcessosIdTbProcessosStatus, "tb_processos_complemento", "complemento");
		}
		$tbProcessosPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['palavras_chave']);
		
		$tbProcessosValor = $linhaProcessosDetalhes['valor'];
		$tbProcessosValor1 = $linhaProcessosDetalhes['valor1'];
		$tbProcessosValor2 = $linhaProcessosDetalhes['valor2'];
		$tbProcessosValor3 = $linhaProcessosDetalhes['valor3'];
		$tbProcessosValor4 = $linhaProcessosDetalhes['valor4'];
		$tbProcessosValor5 = $linhaProcessosDetalhes['valor5'];
		$tbProcessosURL1 = $linhaProcessosDetalhes['url1'];
		$tbProcessosURL2 = $linhaProcessosDetalhes['url2'];
		$tbProcessosURL3 = $linhaProcessosDetalhes['url3'];
		$tbProcessosURL4 = $linhaProcessosDetalhes['url4'];
		$tbProcessosURL5 = $linhaProcessosDetalhes['url5'];

		$tbProcessosIC1 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar1']);
		$tbProcessosIC2 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar2']);
		$tbProcessosIC3 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar3']);
		$tbProcessosIC4 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar4']);
		$tbProcessosIC5 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar5']);
		$tbProcessosIC6 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar6']);
		$tbProcessosIC7 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar7']);
		$tbProcessosIC8 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar8']);
		$tbProcessosIC9 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar9']);
		$tbProcessosIC10 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar10']);
		$tbProcessosIC11 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar11']);
		$tbProcessosIC12 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar12']);
		$tbProcessosIC13 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar13']);
		$tbProcessosIC14 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar14']);
		$tbProcessosIC15 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar15']);
		$tbProcessosIC16 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar16']);
		$tbProcessosIC17 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar17']);
		$tbProcessosIC18 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar18']);
		$tbProcessosIC19 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar19']);
		$tbProcessosIC20 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar20']);
		$tbProcessosIC21 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar21']);
		$tbProcessosIC22 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar22']);
		$tbProcessosIC23 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar23']);
		$tbProcessosIC24 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar24']);
		$tbProcessosIC25 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar25']);
		$tbProcessosIC26 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar26']);
		$tbProcessosIC27 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar27']);
		$tbProcessosIC28 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar28']);
		$tbProcessosIC29 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar29']);
		$tbProcessosIC30 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar30']);
		$tbProcessosIC31 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar31']);
		$tbProcessosIC32 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar32']);
		$tbProcessosIC33 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar33']);
		$tbProcessosIC34 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar34']);
		$tbProcessosIC35 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar35']);
		$tbProcessosIC36 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar36']);
		$tbProcessosIC37 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar37']);
		$tbProcessosIC38 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar38']);
		$tbProcessosIC39 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar39']);
		$tbProcessosIC40 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar40']);
		$tbProcessosIC41 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar41']);
		$tbProcessosIC42 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar42']);
		$tbProcessosIC43 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar43']);
		$tbProcessosIC44 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar44']);
		$tbProcessosIC45 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar45']);
		$tbProcessosIC46 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar46']);
		$tbProcessosIC47 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar47']);
		$tbProcessosIC48 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar48']);
		$tbProcessosIC49 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar49']);
		$tbProcessosIC50 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar50']);
		$tbProcessosIC51 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar51']);
		$tbProcessosIC52 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar52']);
		$tbProcessosIC53 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar53']);
		$tbProcessosIC54 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar54']);
		$tbProcessosIC55 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar55']);
		$tbProcessosIC56 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar56']);
		$tbProcessosIC57 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar57']);
		$tbProcessosIC58 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar58']);
		$tbProcessosIC59 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar59']);
		$tbProcessosIC60 = Funcoes::ConteudoMascaraLeitura($linhaProcessosDetalhes['informacao_complementar60']);
		
		$tbProcessosAtivacao = $linhaProcessosDetalhes['ativacao'];
		$tbProcessosAtivacao1 = $linhaProcessosDetalhes['ativacao1'];
		$tbProcessosAtivacao2 = $linhaProcessosDetalhes['ativacao2'];
		$tbProcessosAtivacao3 = $linhaProcessosDetalhes['ativacao3'];
		$tbProcessosAtivacao4 = $linhaProcessosDetalhes['ativacao4'];
		
		$tbProcessosNVisitas = $linhaProcessosDetalhes['n_visitas'];
		$tbProcessosAcessoRestrito = $linhaProcessosDetalhes['acesso_restrito'];
		
		//Verificação de erro.
		//echo "tbProcessosId=" . $tbProcessosId . "<br>";
		//echo "tbProcessosProcesso=" . $tbProcessosProcesso . "<br>";
		
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo $tbProcessosProcesso; ?>
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
	<?php echo $tbProcessosProcesso; ?>
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
    <div align="center" style="position: relative; display: block;">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosTbProcessosDetalhes"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarProcessosVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosVinculo1Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php if(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro1, "tb_cadastro", "id") <> ""){ ?>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbProcessosIdTbCadastro1;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1)); ?>
                            </a>
						<?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosVinculo2Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php if(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro2, "tb_cadastro", "id") <> ""){ ?>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbProcessosIdTbCadastro2;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro2, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro2, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 1)); ?>
                            </a>
						<?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosVinculo3Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php if(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro3, "tb_cadastro", "id") <> ""){ ?>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbProcessosIdTbCadastro3;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro3, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro3, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 1)); ?>
                            </a>
						<?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosDataAbertura"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
						<?php echo $tbProcessosDataAbertura; ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarProcessosDataDistribuicao'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosDataDistribuicao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<?php echo $tbProcessosDataDistribuicao; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosDataAdmissao'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosDataAdmissao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<?php echo $tbProcessosDataAdmissao; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosDataDemissao'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosDataDemissao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<?php echo $tbProcessosDataDemissao; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosData1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosData1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
						<?php echo $tbProcessosData1; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcesso"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
						<?php echo $tbProcessosProcesso; ?>
                    </div>
                </td>
            </tr>
                        
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosDescricao; ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarProcessosStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIdTbProcessosStatusPrint;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosValor'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosValor"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php echo $tbProcessosValor; ?>
                    </div>
                </td>
            </tr>
			<?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico01Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "12", "", ",", "", "1"));
						$arrProcessosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 12);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico01); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico01[$countArray][0], $arrProcessosFiltroGenerico01Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico01[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico02Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "13", "", ",", "", "1"));
						$arrProcessosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 13);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico02); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico02[$countArray][0], $arrProcessosFiltroGenerico02Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico02[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico03Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "14", "", ",", "", "1"));
						$arrProcessosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 14);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico03); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico03[$countArray][0], $arrProcessosFiltroGenerico03Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico03[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarProcessosFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico04Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "15", "", ",", "", "1"));
						$arrProcessosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 15);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico04); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico04[$countArray][0], $arrProcessosFiltroGenerico04Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico04[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico05Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "16", "", ",", "", "1"));
						$arrProcessosFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 16);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico05); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico05[$countArray][0], $arrProcessosFiltroGenerico05Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico05[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico06Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "17", "", ",", "", "1"));
						$arrProcessosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 17);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico06); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico06[$countArray][0], $arrProcessosFiltroGenerico06Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico06[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico07Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "18", "", ",", "", "1"));
						$arrProcessosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 18);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico07); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico07[$countArray][0], $arrProcessosFiltroGenerico07Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico07[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico08Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "19", "", ",", "", "1"));
						$arrProcessosFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 19);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico08); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico08[$countArray][0], $arrProcessosFiltroGenerico08Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico08[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico09Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "20", "", ",", "", "1"));
						$arrProcessosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 20);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico09); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico09[$countArray][0], $arrProcessosFiltroGenerico09Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico09[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosFiltroGenerico10Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrProcessosFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbProcessosId, "tb_processos_relacao_complemento", "id_tb_processos", "id_tb_processos_complemento", "21", "", ",", "", "1"));
						$arrProcessosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_processos_complemento", 21);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrProcessosFiltroGenerico10); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrProcessosFiltroGenerico10[$countArray][0], $arrProcessosFiltroGenerico10Selecao)){ ?> 
                                    - <?php echo $arrProcessosFiltroGenerico10[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosURL1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configProcessosURL1Titulo']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<a href="<?php echo $tbProcessosURL1; ?>" target="_blank" class="AdmLinks01"> 
                        	<?php echo $tbProcessosURL1; ?>
                        </a>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC1;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc2']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC2;?>
                    </div>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc3']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC3;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc4']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC4;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc5']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC5;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc6']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC6;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc7']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC7;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc8']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC8;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc9']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC9;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc10']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC10;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc11']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC11;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc12']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC12;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc13']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC13;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc14']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC14;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc15']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC15;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc16']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC16;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc17']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC17;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc18']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC18;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc19']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC19;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc20']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC20;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc21']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC21;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc22']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC22;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc23']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC23;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc24']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC24;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc25']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC25;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc26']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC26;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc27']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC27;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc28']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC28;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc29']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC29;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc30']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC30;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc31']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC31;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc32']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC32;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc33']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC33;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc34']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC34;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc35']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC35;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc36']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC36;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc37']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC37;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc38']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC38;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc39']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC39;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc40']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC40;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc41'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc41']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC41;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc42'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc42']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC42;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc43']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC43;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc44'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc44']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC44;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc45'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc45']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC45;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc46'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc46']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC46;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc47'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc47']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC47;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc48'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc48']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC48;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc49']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC49;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc50']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC50;?>
                    </div>
                </td>
            </tr>
            <?php } ?>  
            
            <?php if($GLOBALS['habilitarProcessosIc51'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc51']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC51;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc52'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc52']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC52;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc53'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc53']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC53;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc54'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc54']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC54;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc55'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc55']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC55;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc56'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc56']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC56;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarProcessosIc57'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc57']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC57;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc58'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc58']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC58;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc59'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc59']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC59;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarProcessosIc60'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloProcessosIc60']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbProcessosIC60;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php //**************************************************************************************?>

    
	<?php //Imagens complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivosImagens_idTbArquivos = $tbProcessosId;
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
	$includeArquivos_idTbArquivos = $tbProcessosId;
	$includeArquivos_tipoVisualizacao = "1";
	$includeArquivos_configArquivosNColunas = "1";
	
	$includeArquivos_limiteRegistros = "";
	$includeArquivos_nImagensVisivelScroll = "1";
	?>
    
    <?php include "IncludeArquivos.php";?>
    <?php //----------------------?>
    
    
	<?php //Histórico.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmHistorico_idParent = $tbProcessosId;
	$includeAdmHistorico_idTbCadastroUsuario = "";
	$includeAdmHistorico_idTbHistoricoStatusSelect = "";
	
	$includeAdmHistorico_tipoDiagramacao = "1";
	$includeAdmHistorico_limiteRegistros = "";
	?>
    <?php include "IncludeHistorico.php";?>
    <?php //----------------------?>
    
    
	<?php //Histórico - ADM.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmHistorico_idParent = $tbProcessosId;
	$includeAdmHistorico_idTbCadastroUsuario = "";
	$includeAdmHistorico_idTbHistoricoStatusSelect = "";
	
	$includeAdmHistorico_tipoDiagramacao = "1";
	$includeAdmHistorico_limiteRegistros = "";
	
	$includeAdmHistorico_paginaRetornoHistorico = "SiteProcessosDetalhes.php";
	$includeAdmHistorico_variavelRetornoHistorico = "idTbProcessos";
	$includeAdmHistorico_variavelRetornoValorHistorico = $idTbProcessos;
	$includeAdmHistorico_masterPageSiteSelect = $masterPageSiteSelect;
	
	?>
    <?php include "IncludeAdmHistoricoIndice.php";?>
    <?php //----------------------?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlProcessosDetalhesSelect);
unset($statementProcessosDetalhesSelect);
unset($resultadoProcessosDetalhes);
unset($linhaProcessosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>