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
$idParent = $_GET["idParent"];
$idTbHistoricoStatus = $_GET["idTbHistoricoStatus"];
$idTbCadastroUsuarioSelect = $_GET["idTbCadastroUsuarioSelect"];
$idTbHistoricoStatusSelect = $_GET["idTbHistoricoStatusSelect"];
/*
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}
*/

$dataAtual = "";
if($configSistemaFormatoData == 1)
{
	$dataAtual = date("d") . "/" . date("m") . "/" . date("Y");
	
}
if($configSistemaFormatoData == 2)
{
	$dataAtual = date("m") . "/" . date("d") . "/" . date("Y");
}

$dataInicial = $_GET["dataInicial"];
$dataFinal = $_GET["dataFinal"];
$dataInicialConvert = strtotime(Funcoes::DataGravacaoSql($dataInicial, $GLOBALS['configSiteFormatoData']));
$dataFinalConvert = strtotime(Funcoes::DataGravacaoSql($dataFinal, $GLOBALS['configSiteFormatoData']));

//Definição de valores de variáveis.
if($dataInicial <> "" && $dataFinal <> "")
{
	//$diaDataInicial = $_GET["diaDataInicial"];
	//$mesDataInicial = $_GET["mesDataInicial"];
	//$anoDataInicial = $_GET["anoDataInicial"];
//}else{
	$diaDataInicial = date('d', $dataInicialConvert);
	$mesDataInicial = date('m', $dataInicialConvert);
	$anoDataInicial = date('Y', $dataInicialConvert);
	
	$diaDataFinal = date('d', $dataFinalConvert);
	$mesDataFinal = date('m', $dataFinalConvert);
	$anoDataFinal = date('Y', $dataFinalConvert);
}

//Manutenção - acesso.
$configManutencaoLink = 3;//0 - não exibir | 1 - página com todos as opções | 2 - página com opções específicas | 3 - ajax
$configManutencaoLinkFlag = true;

$paginaRetorno = "SiteAdmHistoricoIndice.php";
$paginaRetornoExclusao = "SiteAdmHistoricoIndice.php";
$variavelRetorno = "idParent";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&idTbHistoricoStatusSelect=" . $idTbHistoricoStatusSelect . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlHistoricoSelect = "";
$strSqlHistoricoSelect .= "SELECT ";
//$strSqlHistoricoSelect .= "* ";
$strSqlHistoricoSelect .= "id, ";
$strSqlHistoricoSelect .= "id_parent, ";
$strSqlHistoricoSelect .= "id_tb_cadastro_usuario, ";
$strSqlHistoricoSelect .= "data_historico, ";

if($GLOBALS['habilitarHistoricoData1'] == 1){
	$strSqlHistoricoSelect .= "data1, ";
}
if($GLOBALS['habilitarHistoricoData2'] == 1){
	$strSqlHistoricoSelect .= "data2, ";
}
if($GLOBALS['habilitarHistoricoData3'] == 1){
	$strSqlHistoricoSelect .= "data3, ";
}
if($GLOBALS['habilitarHistoricoData4'] == 1){
	$strSqlHistoricoSelect .= "data4, ";
}
if($GLOBALS['habilitarHistoricoData5'] == 1){
	$strSqlHistoricoSelect .= "data5, ";
}

$strSqlHistoricoSelect .= "assunto, ";
$strSqlHistoricoSelect .= "historico, ";
$strSqlHistoricoSelect .= "id_tb_cadastro1, ";
$strSqlHistoricoSelect .= "id_tb_cadastro2, ";
$strSqlHistoricoSelect .= "id_tb_cadastro3, ";

/*
$strSqlHistoricoSelect .= "informacao_complementar1, ";
$strSqlHistoricoSelect .= "informacao_complementar2, ";
$strSqlHistoricoSelect .= "informacao_complementar3, ";
$strSqlHistoricoSelect .= "informacao_complementar4, ";
$strSqlHistoricoSelect .= "informacao_complementar5, ";
$strSqlHistoricoSelect .= "informacao_complementar6, ";
$strSqlHistoricoSelect .= "informacao_complementar7, ";
$strSqlHistoricoSelect .= "informacao_complementar8, ";
$strSqlHistoricoSelect .= "informacao_complementar9, ";
$strSqlHistoricoSelect .= "informacao_complementar10, ";
*/
if($GLOBALS['habilitarHistoricoIc1'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar1, ";
}
if($GLOBALS['habilitarHistoricoIc2'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar2, ";
}
if($GLOBALS['habilitarHistoricoIc3'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar3, ";
}
if($GLOBALS['habilitarHistoricoIc4'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar4, ";
}
if($GLOBALS['habilitarHistoricoIc5'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar5, ";
}
if($GLOBALS['habilitarHistoricoIc6'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar6, ";
}
if($GLOBALS['habilitarHistoricoIc7'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar7, ";
}
if($GLOBALS['habilitarHistoricoIc8'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar8, ";
}
if($GLOBALS['habilitarHistoricoIc9'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar9, ";
}
if($GLOBALS['habilitarHistoricoIc10'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar10, ";
}
if($GLOBALS['habilitarHistoricoIc11'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar11, ";
}
if($GLOBALS['habilitarHistoricoIc12'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar12, ";
}
if($GLOBALS['habilitarHistoricoIc13'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar13, ";
}
if($GLOBALS['habilitarHistoricoIc14'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar14, ";
}
if($GLOBALS['habilitarHistoricoIc15'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar15, ";
}
if($GLOBALS['habilitarHistoricoIc16'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar16, ";
}
if($GLOBALS['habilitarHistoricoIc17'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar17, ";
}
if($GLOBALS['habilitarHistoricoIc18'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar18, ";
}
if($GLOBALS['habilitarHistoricoIc19'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar19, ";
}
if($GLOBALS['habilitarHistoricoIc20'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar20, ";
}
if($GLOBALS['habilitarHistoricoIc21'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar21, ";
}
if($GLOBALS['habilitarHistoricoIc22'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar22, ";
}
if($GLOBALS['habilitarHistoricoIc23'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar23, ";
}
if($GLOBALS['habilitarHistoricoIc24'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar24, ";
}
if($GLOBALS['habilitarHistoricoIc25'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar25, ";
}
if($GLOBALS['habilitarHistoricoIc26'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar26, ";
}
if($GLOBALS['habilitarHistoricoIc27'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar27, ";
}
if($GLOBALS['habilitarHistoricoIc28'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar28, ";
}
if($GLOBALS['habilitarHistoricoIc29'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar29, ";
}
if($GLOBALS['habilitarHistoricoIc30'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar30, ";
}
if($GLOBALS['habilitarHistoricoIc31'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar31, ";
}
if($GLOBALS['habilitarHistoricoIc32'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar32, ";
}
if($GLOBALS['habilitarHistoricoIc33'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar33, ";
}
if($GLOBALS['habilitarHistoricoIc34'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar34, ";
}
if($GLOBALS['habilitarHistoricoIc35'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar35, ";
}
if($GLOBALS['habilitarHistoricoIc36'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar36, ";
}
if($GLOBALS['habilitarHistoricoIc37'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar37, ";
}
if($GLOBALS['habilitarHistoricoIc38'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar38, ";
}
if($GLOBALS['habilitarHistoricoIc39'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar39, ";
}
if($GLOBALS['habilitarHistoricoIc40'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar40, ";
}
if($GLOBALS['habilitarHistoricoIc41'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar41, ";
}
if($GLOBALS['habilitarHistoricoIc42'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar42, ";
}
if($GLOBALS['habilitarHistoricoIc43'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar43, ";
}
if($GLOBALS['habilitarHistoricoIc44'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar44, ";
}
if($GLOBALS['habilitarHistoricoIc45'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar45, ";
}
if($GLOBALS['habilitarHistoricoIc46'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar46, ";
}
if($GLOBALS['habilitarHistoricoIc47'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar47, ";
}
if($GLOBALS['habilitarHistoricoIc48'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar48, ";
}
if($GLOBALS['habilitarHistoricoIc49'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar49, ";
}
if($GLOBALS['habilitarHistoricoIc50'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar50, ";
}
if($GLOBALS['habilitarHistoricoIc51'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar51, ";
}
if($GLOBALS['habilitarHistoricoIc52'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar52, ";
}
if($GLOBALS['habilitarHistoricoIc53'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar53, ";
}
if($GLOBALS['habilitarHistoricoIc54'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar54, ";
}
if($GLOBALS['habilitarHistoricoIc55'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar55, ";
}
if($GLOBALS['habilitarHistoricoIc56'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar56, ";
}
if($GLOBALS['habilitarHistoricoIc57'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar57, ";
}
if($GLOBALS['habilitarHistoricoIc58'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar58, ";
}
if($GLOBALS['habilitarHistoricoIc59'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar59, ";
}
if($GLOBALS['habilitarHistoricoIc60'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar60, ";
}

$strSqlHistoricoSelect .= "ativacao, ";
$strSqlHistoricoSelect .= "ativacao1, ";
$strSqlHistoricoSelect .= "ativacao2, ";
$strSqlHistoricoSelect .= "ativacao3, ";
$strSqlHistoricoSelect .= "ativacao4, ";
$strSqlHistoricoSelect .= "id_tb_historico_status ";
$strSqlHistoricoSelect .= "FROM tb_historico ";
$strSqlHistoricoSelect .= "WHERE id <> 0 ";
if($idParent <> "")
{
	$strSqlHistoricoSelect .= "AND id_parent = :id_parent ";
}
if($idTbHistoricoStatus <> "")
{
	$strSqlHistoricoSelect .= "AND id_tb_historico_status = :id_tb_historico_status ";
}
if($dataInicial <> "" && $dataFinal <> "")
{
	$strSqlHistoricoSelect .= "AND data_historico BETWEEN '" . $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial . "' AND '" . $anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal . "' ";
	//$strSqlHistoricoSelect .= "AND data_historico BETWEEN DATE(:dataInicial) AND DATE(:dataFinal) ";
	//$strSqlHistoricoSelect .= "AND data_historico BETWEEN :dataInicial AND :dataFinal ";
}
$strSqlHistoricoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroHistorico'] . " ";
//echo "strSqlHistoricoSelect=" . $strSqlHistoricoSelect . "<br />";
//----------

//Criação de componentes e parâmetros.
//----------
$statementHistoricoSelect = $dbSistemaConPDO->prepare($strSqlHistoricoSelect);

if ($statementHistoricoSelect !== false)
{
	/*
	$statementHistoricoSelect->execute(array(
		"id_parent" => $idParent
	));
	*/
	if($idParent <> "")
	{
		$statementHistoricoSelect->bindParam(':id_parent', $idParent, PDO::PARAM_STR);
	}
	if($idTbHistoricoStatus <> "")
	{
		$statementHistoricoSelect->bindParam(':id_tb_historico_status', $idTbHistoricoStatus, PDO::PARAM_STR);
	}
	if($dataInicial <> "" && $dataFinal <> "")
	{
		//Não funcionou.
		//$statementHistoricoSelect->bindParam(':dataInicial', $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial, PDO::PARAM_STR);
		//$statementHistoricoSelect->bindParam(':dataFinal', $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial, PDO::PARAM_STR);
	}
	$statementHistoricoSelect->execute();
}

//$resultadoHistorico = $dbSistemaConPDO->query($strSqlHistoricoSelect);
$resultadoHistorico = $statementHistoricoSelect->fetchAll();
//----------


//Definição de variáveis.
if($idParent <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelHistoricoAdministrar");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Objeto - Produtos.
//----------
//Detalhes do produto vinculado.
$opdProdutoVinculado = new ObjetoProdutosDetalhes(); //Criação de objeto com os detalhes do cadastro.
if(DbFuncoes::GetCampoGenerico01($idParent, "tb_produtos", "id") <> "")
{
	//$resultadoCadastroDetalhes = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_cadastro", array("id;" . $idTbCadastroLogado . ";i"));	
	
	//Definição dos valores do cadastro logado.
	$opdProdutoVinculado->ProdutosDetalhesResultado($idParent, 1);
	
	
	//Verificação de erro - debug.
	//echo "tbProdutosId=" . $opdProdutoVinculado->tbProdutosId . "<br />";
	//echo "tbProdutosProduto=" . $opdProdutoVinculado->tbProdutosProduto . "<br />";
}
/**/
//----------


//Verificação de erro - debug.
//echo "dataTarefaPesquisa=" . $dataTarefaPesquisa . "<br />";
//echo "palavraChave=" . $palavraChave . "<br />";
//echo "idParent=" . $idParent . "<br />";
//echo "strSqlTarefasSelect=" . $strSqlTarefasSelect . "<br />";
//echo "statementTarefasSelect(debugDumpParams)=" . $statementTarefasSelect->debugDumpParams() . "<br />";
//echo "statementTarefasSelect(debugDumpParams)=" . print_r($statementTarefasSelect->debugDumpParams()) . "<br />";
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo $tituloLinkAtual; ?>
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
    
    <?php
	//if (empty($resultadoHistorico))
	//{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro" style="display: none;">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemHistoricoVazio"); ?>
        </div>
    <?php
    //}else{
    ?>

        <form name="formHistoricoAcoes" id="formHistoricoAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico" />
            <input name="idParent" id="idParent" type="hidden" value="<?php echo $idParent; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            
            <input name="idTbHistoricoStatusSelect" type="hidden" id="idTbHistoricoStatusSelect" value="<?php echo $idTbHistoricoStatusSelect; ?>" />
            <div style="position: relative; display: block; width: 938px; height: 110px; border: 1px solid #000000; background-color: #ffffff; overflow: auto;">
            <table width="100%" class="AdmTabelaDados01">
              <tr class="">
                <?php if($GLOBALS['habilitarHistoricoAdmExclusao'] == 1){ ?>
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmErro">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarHistoricoAdmEdicao'] == 1){ ?>
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                <?php } ?>

              	<?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoProtocolo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="60" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoData"); ?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['habilitarHistoricoData1'] == 1){ ?>
                <td width="60" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData1'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistorico"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?> (Est. de Cons.)
                    </div>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?> (Tratamento)
                    </div>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?> (Acond.)
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>

                <td width="60" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                        Impress&atilde;o
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
                <td width="100">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countRegistros = 0;
				
				
				$countTabelaFundo = 0;
			  	$arrHistoricoStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 4);
			  
                //Loop pelos resultados.
                foreach($resultadoHistorico as $linhaHistorico)
                {
				  $countRegistros++;
					
              ?>
              <tr class="">
                <?php if($GLOBALS['habilitarHistoricoAdmExclusao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistorico['id'];?>" class="CampoCheckBox01" />
                    	<?php } ?>
                    </div>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarHistoricoAdmEdicao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmHistoricoEditar.php?idTbHistorico=<?php echo $linhaHistorico['id'];?><?php echo $queryPadrao;?>" target="_parent" class="AdmLinks01">
                            <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            <img src="img/btoEditar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>" />
                        </a>
                    </div>
                </td>
                <?php } ?>
              
              	<?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaHistorico['id'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaHistorico['data_historico'];?>
                        <?php echo Funcoes::DataLeitura01($linhaHistorico['data_historico'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['habilitarHistoricoData1'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaHistorico['data_historico'];?>
                        <?php echo Funcoes::DataLeitura01($linhaHistorico['data1'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>
                        </strong>
                    </div>
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['historico']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarHistoricoFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaHistorico['id'];?>&tipoArquivo=1&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarHistoricoVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaHistorico['id'];?>&tipoArquivo=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarHistoricoArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaHistorico['id'];?>&tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarHistoricoZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaHistorico['id'];?>&tipoArquivo=4&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarHistoricoSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaHistorico['id'];?>&tipoArquivo=5&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarHistoricoConteudo'] == 1){ ?>
                            [
                            <a href="SiteAdmConteudoIndice.php?idParentConteudo=<?php echo $linhaHistorico['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirConteudo"); ?>
                            </a>
                            ] 
                        <?php } ?>

                    	<?php if($GLOBALS['habilitarHistoricoForumPostagens'] == 1){ ?>
                            [
                            <a href="SiteAdmForumPostagensIndice.php?idTbForumTopicos=<?php echo $linhaHistorico['id'];?>" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumTopicosPostagegensAdministrar"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>

                    
                    <?php if($GLOBALS['habilitarCadastroHistoricoUsuario'] == 1){ ?>
						<?php if($linhaHistorico['id_tb_cadastro_usuario'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoCadastroUsuario"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_parent'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php //if(empty($idParent)){ ?>
                    <?php if($idParent == ""){ ?>
						<?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_parent'], "tb_cadastro", "id") <> ""){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoCadastroVinculado"); ?>: 
                                </strong>
                                <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_parent']; /*$idParent;*/?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_parent'], "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01($linhaHistorico['id_parent'], "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01($linhaHistorico['id_parent'], "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            </div>
						<?php } ?>
                     <?php } ?>
                     
                     
					<?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
                        <?php //if($linhaHistorico['id_tb_cadastro1'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php //} ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
                        <?php //if($linhaHistorico['id_tb_cadastro2'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php //} ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
                        <?php //if($linhaHistorico['id_tb_cadastro3'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php //} ?>
                    <?php } ?>  
                </td>
                
                <?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                        <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                        </a>
							<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                            DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                            DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                            1)); ?>
                    </div>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                        <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                        </a>
							<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                            DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                            DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                            1)); ?>
                    </div>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                        <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                        </a>
							<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                            DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                            DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                            1)); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaHistorico['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php
						if($linhaHistorico['ativacao'] == 1)
						{
							$statusAtivacao = 1;
						}else{
							$statusAtivacao = 0;	
						}
						
						//&statusAtivacao=php echo $linhaHistorico['ativacao'];
						?>
                        <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaHistorico['id'];?>&statusAtivacao=<?php echo $statusAtivacao;?>&strTabela=tb_historico&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaHistorico['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaHistorico['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
                    	<?php }else{ ?>
                        	<?php if($linhaHistorico['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaHistorico['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                    	<?php } ?>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteHistoricoDetalhes.php?idTbHistorico=<?php echo $linhaHistorico['id'];?>&masterPageSiteSelect=LayoutSiteImpressao.php" target="_blank" class="AdmLinks01">
                            <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                            <!--Impress&atilde;o-->
                            <img src="img/btoImpressao.png" alt="Impress&atilde;o" />
                        </a>
                    </div>
                    <?php if($GLOBALS['habilitarCadastroHistoricoInteracao'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmHistoricoInteracaoIndice.php?idParent=<?php echo $linhaHistorico['id'];?>" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracao"); ?>
                            </a>
                        </div>
                    <?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrHistoricoStatus); $countArray++)
                        {
                        ?>
                        	<?php if($arrHistoricoStatus[$countArray][0] == $linhaHistorico['id_tb_historico_status']){ ?>
								<?php echo $arrHistoricoStatus[$countArray][1];?>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaHistorico['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaHistorico['id'];?>" class="AdmCampoRadioButton01" />
                    </div>
                </td>
              </tr>
              <?php 
				  //Linha alternativa de tabela.
				  //----------
				  //$countTabelaFundo = $countTabelaFundo + 1;
				  $countTabelaFundo++;
				
				   if($countTabelaFundo == 2)
				   {
					   $countTabelaFundo = 0;
				   }
				  //----------
				} 
			  ?>
            </table>
            </div>
            
                <?php if($GLOBALS['habilitarHistoricoAdmEdicao'] == 1){ ?>
					<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){ ?>
                    <div align="right" style="float: right; margin-right: 50px;">
                        <div class="AdmDivBto01" onclick="btoClick_onEvent('btoHistoricoExcluir');" style="margin-right: 0px; margin-top: 0px;">
                            <a class="AdmLinks01">
                                Remover
                            </a>
                        </div>
                    
                        <input id="btoHistoricoExcluir" type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" style="display: none;" />
                    </div>
					<?php } ?>
                <?php } ?>
        </form>
        <div class="AdmTexto01" style="position: relative; display: none;">
            TOTAL: <?php echo $countRegistros;?>
        </div>
	<?php //} ?>
    
    
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
        //Obs: modifiquei o posicionamento da definição de variávei para fora da condição de exibição do formulário.
		
		
		$(document).ready(function(){
			//Atualizar um determinado frame no carregamento da página (funcionando).
			//parent.iframeRecarregar('iframeAdmHistorico', '');
		});
    </script>

    <form name="formHistorico" id="formHistorico" action="SiteAdmHistoricoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="AdmTabelaCampos01" style="display: none;">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTbHistorico"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoData"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                        	<?php //Data fixa. ?>
                            <?php if($GLOBALS['configCadastroHistoricoAdmDataEdicao'] == 0){ ?>
                            	<?php echo $dataAtual; ?>
                            <?php } ?>
                        
                        	<?php //Edição de data. ?>
                        	<?php if($GLOBALS['configCadastroHistoricoAdmDataEdicao'] == 1){ ?>
								<?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            var strDatapickerAgendaPtCampos = "#data_interacao";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            var strDatapickerAgendaEnCampos = "#data_interacao";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data_interacao" id="data_interacao" class="AdmCampoData01" maxlength="10" value="<?php echo $dataAtual; ?>" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
    
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoAssunto"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="assunto" id="assunto" class="AdmCampoTexto02" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistorico"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="historico" id="historico" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#historico").cleditor(
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
                                <textarea name="historico" id="historico"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#historico").cleditor(
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
                                <textarea name="historico" id="historico"></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 12);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico01CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico01[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico01[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico01CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico01" name="idsHistoricoFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico01[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico01[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico01CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico01" name="idsHistoricoFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico01[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico01[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico01))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=12&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=12&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=12&tipoRetorno=3\', \'idsHistoricoFiltroGenerico01\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico01CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico02'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 13);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico02CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico02[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico02[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico02CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico02" name="idsHistoricoFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico02[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico02[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico02CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico02" name="idsHistoricoFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico02[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico02[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico02))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=13&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=13&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=13&tipoRetorno=3\', \'idsHistoricoFiltroGenerico02\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico02CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico03'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 14);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico03[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico03" name="idsHistoricoFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico03" name="idsHistoricoFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico03))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=14&tipoRetorno=3\', \'idsHistoricoFiltroGenerico03\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico04'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 15);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico04[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico04" name="idsHistoricoFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico04" name="idsHistoricoFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico04))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=15&tipoRetorno=3\', \'idsHistoricoFiltroGenerico04\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico05'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 16);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico05[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico05[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico05" name="idsHistoricoFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico05[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico05[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico05" name="idsHistoricoFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico05[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico05[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico05))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=16&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=16&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=16&tipoRetorno=3\', \'idsHistoricoFiltroGenerico05\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico06'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 17);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico06[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico06[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico06" name="idsHistoricoFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico06[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico06[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico06" name="idsHistoricoFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico06[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico06[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico06))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=17&tipoRetorno=3\', \'idsHistoricoFiltroGenerico06\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico07'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 18);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico07[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico07[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico07" name="idsHistoricoFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico07[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico07[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico07" name="idsHistoricoFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico07[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico07[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico07))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=18&tipoRetorno=3\', \'idsHistoricoFiltroGenerico07\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico08'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 19);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico08[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico08[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico08" name="idsHistoricoFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico08[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico08[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico08" name="idsHistoricoFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico08[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico08[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico08))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=19&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=19&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=19&tipoRetorno=3\', \'idsHistoricoFiltroGenerico08\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico09'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 20);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico09[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico09[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico09" name="idsHistoricoFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico09[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico09[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico09" name="idsHistoricoFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico09[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico09[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico09))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=20&tipoRetorno=3\', \'idsHistoricoFiltroGenerico09\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico10'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 21);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico10[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico10[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico10" name="idsHistoricoFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico10[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico10[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico10" name="idsHistoricoFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico10[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico10[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico10))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=21&tipoRetorno=3\', \'idsHistoricoFiltroGenerico10\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico11'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 22);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico11[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico11[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico11[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico11" name="idsHistoricoFiltroGenerico11[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico11[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico11[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico11" name="idsHistoricoFiltroGenerico11[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico11[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico11[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico11))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=22&tipoRetorno=3\', \'idsHistoricoFiltroGenerico11\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico12'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 23);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico12[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico12[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico12[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico12" name="idsHistoricoFiltroGenerico12[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico12[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico12[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico12" name="idsHistoricoFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico12[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico12[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico12))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=23&tipoRetorno=3\', \'idsHistoricoFiltroGenerico12\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico13'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 24);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico13[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico13[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico13[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico13" name="idsHistoricoFiltroGenerico13[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico13[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico13[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico13" name="idsHistoricoFiltroGenerico13[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico13[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico13[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico13))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=24&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=24&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=24&tipoRetorno=3\', \'idsHistoricoFiltroGenerico13\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico14'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 25);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico14[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico14[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico14[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico14" name="idsHistoricoFiltroGenerico14[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico14[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico14[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico14" name="idsHistoricoFiltroGenerico14[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico14[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico14[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico14))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=25&tipoRetorno=3\', \'idsHistoricoFiltroGenerico14\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico15'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 26);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico15[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico15[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico15[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico15" name="idsHistoricoFiltroGenerico15[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico15[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico15[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico15" name="idsHistoricoFiltroGenerico15[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico15[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico15[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico15))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=26&tipoRetorno=3\', \'idsHistoricoFiltroGenerico15\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico16'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 27);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico16CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico16[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico16[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico16[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico16CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico16" name="idsHistoricoFiltroGenerico16[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico16); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico16[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico16[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico16CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico16" name="idsHistoricoFiltroGenerico16[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico16); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico16[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico16[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico16))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=27&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=27&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=27&tipoRetorno=3\', \'idsHistoricoFiltroGenerico16\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico16CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico17'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 28);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico17CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico17[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico17[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico17[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico17CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico17" name="idsHistoricoFiltroGenerico17[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico17); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico17[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico17[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico17CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico17" name="idsHistoricoFiltroGenerico17[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico17); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico17[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico17[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico17))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=28&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=28&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=28&tipoRetorno=3\', \'idsHistoricoFiltroGenerico17\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico17CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico18'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 29);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico18CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico18[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico18[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico18[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico18CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico18" name="idsHistoricoFiltroGenerico18[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico18); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico18[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico18[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico18CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico18" name="idsHistoricoFiltroGenerico18[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico18); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico18[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico18[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico18))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=29&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=29&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=29&tipoRetorno=3\', \'idsHistoricoFiltroGenerico18\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico18CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico19'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 30);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico19CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico19[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico19[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico19[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico19CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico19" name="idsHistoricoFiltroGenerico19[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico19); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico19[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico19[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico19CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico19" name="idsHistoricoFiltroGenerico19[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico19); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico19[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico19[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico19))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=30&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=30&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=30&tipoRetorno=3\', \'idsHistoricoFiltroGenerico19\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico19CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico20'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 31);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico20CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico20[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico20[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico20[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico20" name="idsHistoricoFiltroGenerico20[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico20); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico20[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico20[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico20" name="idsHistoricoFiltroGenerico20[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico20); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico20[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico20[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico20))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=31&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=31&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=31&tipoRetorno=3\', \'idsHistoricoFiltroGenerico20\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico20CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico21'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico21 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 32);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico21CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico21); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico21[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico21[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico21[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico21CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico21" name="idsHistoricoFiltroGenerico21[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico21); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico21[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico21[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico21CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico21" name="idsHistoricoFiltroGenerico21[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico21); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico21[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico21[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico21))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=32&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=32&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=32&tipoRetorno=3\', \'idsHistoricoFiltroGenerico21\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico21CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico22'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico22 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 33);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico22CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico22); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico22[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico22[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico22[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico22CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico22" name="idsHistoricoFiltroGenerico22[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico22); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico22[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico22[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico22CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico22" name="idsHistoricoFiltroGenerico22[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico22); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico22[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico22[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico22))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=33&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=33&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=33&tipoRetorno=3\', \'idsHistoricoFiltroGenerico22\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico22CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico23'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico23 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 34);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico23CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico23); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico23[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico23[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico23[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico23CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico23" name="idsHistoricoFiltroGenerico23[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico23); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico23[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico23[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico23CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico23" name="idsHistoricoFiltroGenerico23[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico23); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico23[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico23[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico23))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=34&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=34&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=34&tipoRetorno=3\', \'idsHistoricoFiltroGenerico23\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico23CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico24'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico24 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 35);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico24CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico24); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico24[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico24[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico24[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico24CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico24" name="idsHistoricoFiltroGenerico24[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico24); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico24[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico24[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico24CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico24" name="idsHistoricoFiltroGenerico24[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico24); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico24[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico24[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico24))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=35&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=35&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=35&tipoRetorno=3\', \'idsHistoricoFiltroGenerico24\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico24CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico25'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico25 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 36);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico25CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico25); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico25[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico25[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico25[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico25CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico25" name="idsHistoricoFiltroGenerico25[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico25); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico25[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico25[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico25CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico25" name="idsHistoricoFiltroGenerico25[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico25); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico25[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico25[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico25))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=36&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=36&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=36&tipoRetorno=3\', \'idsHistoricoFiltroGenerico25\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico25CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico26'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico26 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 37);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico26CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico26); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico26[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico26[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico26[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico26CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico26" name="idsHistoricoFiltroGenerico26[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico26); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico26[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico26[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico26CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico26" name="idsHistoricoFiltroGenerico26[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico26); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico26[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico26[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico26))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=37&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=37&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=37&tipoRetorno=3\', \'idsHistoricoFiltroGenerico26\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico26CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico27'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico27 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 38);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico27CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico27); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico27[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico27[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico27[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico27CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico27" name="idsHistoricoFiltroGenerico27[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico27); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico27[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico27[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico27CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico27" name="idsHistoricoFiltroGenerico27[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico27); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico27[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico27[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico27))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=38&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=38&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=38&tipoRetorno=3\', \'idsHistoricoFiltroGenerico27\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico27CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico28'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 39);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico28[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico28[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico28[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico28" name="idsHistoricoFiltroGenerico28[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico28[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico28[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico28" name="idsHistoricoFiltroGenerico28[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico28[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico28[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico28))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=39&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=39&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=39&tipoRetorno=3\', \'idsHistoricoFiltroGenerico28\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico29'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico29 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 40);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico29CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico29); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico29[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico29[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico29[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico29CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico29" name="idsHistoricoFiltroGenerico29[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico29); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico29[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico29[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico29CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico29" name="idsHistoricoFiltroGenerico29[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico29); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico29[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico29[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico29))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=40&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=40&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=40&tipoRetorno=3\', \'idsHistoricoFiltroGenerico29\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico29CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico30'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico30 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 41);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico30[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico30[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico30[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico30" name="idsHistoricoFiltroGenerico30[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico30[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico30[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico30" name="idsHistoricoFiltroGenerico30[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico30[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico30[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico30))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=41&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=41&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=41&tipoRetorno=3\', \'idsHistoricoFiltroGenerico30\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico31'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico31 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 42);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico31[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico31[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico31[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico31" name="idsHistoricoFiltroGenerico31[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico31[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico31[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico31" name="idsHistoricoFiltroGenerico31[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico31[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico31[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico31))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=42&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=42&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=42&tipoRetorno=3\', \'idsHistoricoFiltroGenerico31\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico32'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico32 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 43);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico32[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico32[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico32[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico32" name="idsHistoricoFiltroGenerico32[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico32[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico32[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico32" name="idsHistoricoFiltroGenerico32[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico32[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico32[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico32))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=43&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=43&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=43&tipoRetorno=3\', \'idsHistoricoFiltroGenerico32\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico33'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico33 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 44);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico33[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico33[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico33[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico33" name="idsHistoricoFiltroGenerico33[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico33[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico33[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico33" name="idsHistoricoFiltroGenerico33[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico33[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico33[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico33))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=44&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=44&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=44&tipoRetorno=3\', \'idsHistoricoFiltroGenerico33\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico34'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico34 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 45);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico34[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico34[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico34[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico34" name="idsHistoricoFiltroGenerico34[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico34[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico34[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico34" name="idsHistoricoFiltroGenerico34[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico34[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico34[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico34))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=45&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=45&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=45&tipoRetorno=3\', \'idsHistoricoFiltroGenerico34\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico35'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico35 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 46);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico35[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico35[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico35[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico35" name="idsHistoricoFiltroGenerico35[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico35[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico35[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico35" name="idsHistoricoFiltroGenerico35[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico35[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico35[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico35))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=46&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=46&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=46&tipoRetorno=3\', \'idsHistoricoFiltroGenerico35\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico36'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico36 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 47);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico36[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico36[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico36[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico36" name="idsHistoricoFiltroGenerico36[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico36[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico36[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico36" name="idsHistoricoFiltroGenerico36[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico36[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico36[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico36))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=47&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=47&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=47&tipoRetorno=3\', \'idsHistoricoFiltroGenerico36\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico37'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico37 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 48);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico37[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico37[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico37[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico37" name="idsHistoricoFiltroGenerico37[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico37[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico37[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico37" name="idsHistoricoFiltroGenerico37[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico37[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico37[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico37))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=48&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=48&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=48&tipoRetorno=3\', \'idsHistoricoFiltroGenerico37\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico38'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico38 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 49);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico38[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico38[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico38[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico38" name="idsHistoricoFiltroGenerico38[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico38[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico38[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico38" name="idsHistoricoFiltroGenerico38[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico38[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico38[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico38))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=49&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=49&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=49&tipoRetorno=3\', \'idsHistoricoFiltroGenerico38\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico39'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico39 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 50);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico39[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico39[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico39[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico39" name="idsHistoricoFiltroGenerico39[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico39[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico39[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico39" name="idsHistoricoFiltroGenerico39[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico39[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico39[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico39))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=50&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=50&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=50&tipoRetorno=3\', \'idsHistoricoFiltroGenerico39\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico40'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico40 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 51);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico40[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico40[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico40[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico40" name="idsHistoricoFiltroGenerico40[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico40[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico40[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico40" name="idsHistoricoFiltroGenerico40[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico40[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico40[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico40))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=51&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=51&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=51&tipoRetorno=3\', \'idsHistoricoFiltroGenerico40\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico41'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico41 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 52);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico41CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico41); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico41[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico41[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico41[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico41CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico41" name="idsHistoricoFiltroGenerico41[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico41); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico41[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico41[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico41CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico41" name="idsHistoricoFiltroGenerico41[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico41); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico41[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico41[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico41))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=52&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=52&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=52&tipoRetorno=3\', \'idsHistoricoFiltroGenerico41\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico41CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico42'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico42 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 53);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico42[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico42[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico42[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico42" name="idsHistoricoFiltroGenerico42[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico42[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico42[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico42" name="idsHistoricoFiltroGenerico42[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico42[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico42[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico42))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=53&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=53&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=53&tipoRetorno=3\', \'idsHistoricoFiltroGenerico42\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico43'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico43 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 54);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico43[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico43[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico43[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico43" name="idsHistoricoFiltroGenerico43[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico43[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico43[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico43" name="idsHistoricoFiltroGenerico43[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico43[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico43[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico43))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=54&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=54&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=54&tipoRetorno=3\', \'idsHistoricoFiltroGenerico43\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico44'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico44 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 55);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico44CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico44); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico44[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico44[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico44[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico44CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico44" name="idsHistoricoFiltroGenerico44[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico44); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico44[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico44[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico44CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico44" name="idsHistoricoFiltroGenerico44[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico44); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico44[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico44[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico44))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=55&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=55&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=55&tipoRetorno=3\', \'idsHistoricoFiltroGenerico44\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico44CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico45'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico45 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 56);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico45CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico45); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico45[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico45[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico45[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico45CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico45" name="idsHistoricoFiltroGenerico45[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico45); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico45[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico45[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico45CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico45" name="idsHistoricoFiltroGenerico45[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico45); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico45[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico45[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico45))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=56&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=56&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=56&tipoRetorno=3\', \'idsHistoricoFiltroGenerico45\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico45CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico46'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico46 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 57);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico46CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico46); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico46[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico46[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico46[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico46CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico46" name="idsHistoricoFiltroGenerico46[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico46); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico46[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico46[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico46CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico46" name="idsHistoricoFiltroGenerico46[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico46); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico46[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico46[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico46))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=57&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=57&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=57&tipoRetorno=3\', \'idsHistoricoFiltroGenerico46\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico46CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico47'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico47 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 58);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico47CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico47); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico47[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico47[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico47[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico47CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico47" name="idsHistoricoFiltroGenerico47[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico47); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico47[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico47[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico47CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico47" name="idsHistoricoFiltroGenerico47[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico47); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico47[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico47[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico47))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=58&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=58&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=58&tipoRetorno=3\', \'idsHistoricoFiltroGenerico47\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico47CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico48'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico48 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 59);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico48CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico48); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico48[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico48[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico48[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico48CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico48" name="idsHistoricoFiltroGenerico48[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico48); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico48[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico48[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico48CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico48" name="idsHistoricoFiltroGenerico48[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico48); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico48[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico48[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico48))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=59&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=59&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=59&tipoRetorno=3\', \'idsHistoricoFiltroGenerico48\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico48CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico49'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico49 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 60);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico49CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico49); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico49[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico49[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico49[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico49CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico49" name="idsHistoricoFiltroGenerico49[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico49); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico49[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico49[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico49CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico49" name="idsHistoricoFiltroGenerico49[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico49); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico49[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico49[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico49))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=60&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=60masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=60&tipoRetorno=3\', \'idsHistoricoFiltroGenerico49\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico49CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico50'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico50 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 61);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico50[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico50[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico50[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico50" name="idsHistoricoFiltroGenerico50[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico50[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico50[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico50" name="idsHistoricoFiltroGenerico50[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico50[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico50[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico50))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=61masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=61&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=61&tipoRetorno=3\', \'idsHistoricoFiltroGenerico50\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico51'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico51 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 62);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico51[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico51[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico51[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico51" name="idsHistoricoFiltroGenerico51[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico51[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico51[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico51" name="idsHistoricoFiltroGenerico51[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico51[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico51[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico51))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=62&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=62&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=62&tipoRetorno=3\', \'idsHistoricoFiltroGenerico51\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico52'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico52 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 63);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico52CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico52); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico52[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico52[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico52[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico52CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico52" name="idsHistoricoFiltroGenerico52[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico52); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico52[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico52[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico52CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico52" name="idsHistoricoFiltroGenerico52[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico52); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico52[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico52[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico52))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=63&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=63&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=63&tipoRetorno=3\', \'idsHistoricoFiltroGenerico52\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico52CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico53'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico53 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 64);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico53CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico53); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico53[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico53[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico53[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico53CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico53" name="idsHistoricoFiltroGenerico53[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico53); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico53[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico53[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico53CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico53" name="idsHistoricoFiltroGenerico53[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico53); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico53[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico53[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico53))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=64&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=64&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=64&tipoRetorno=3\', \'idsHistoricoFiltroGenerico53\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico53CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico54'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico54 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 65);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico54CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico54); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico54[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico54[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico54[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico54CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico54" name="idsHistoricoFiltroGenerico54[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico54); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico54[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico54[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico54CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico54" name="idsHistoricoFiltroGenerico54[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico54); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico54[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico54[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico54))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=65&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=65&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=65&tipoRetorno=3\', \'idsHistoricoFiltroGenerico54\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico54CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico55'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico55 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 66);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico55CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico55); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico55[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico55[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico55[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico55CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico55" name="idsHistoricoFiltroGenerico55[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico55); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico55[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico55[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico55CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico55" name="idsHistoricoFiltroGenerico55[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico55); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico55[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico55[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico55))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=66&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=66&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=66&tipoRetorno=3\', \'idsHistoricoFiltroGenerico55\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico55CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico56'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico56 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 67);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico56CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico56); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico56[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico56[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico56[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico56CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico56" name="idsHistoricoFiltroGenerico56[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico56); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico56[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico56[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico56CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico56" name="idsHistoricoFiltroGenerico56[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico56); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico56[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico56[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico56))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=67&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=67&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=67&tipoRetorno=3\', \'idsHistoricoFiltroGenerico56\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico56CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico57'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico57 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 68);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico57CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico57); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico57[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico57[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico57[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico57CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico57" name="idsHistoricoFiltroGenerico57[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico57); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico57[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico57[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico57CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico57" name="idsHistoricoFiltroGenerico57[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico57); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico57[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico57[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico57))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=68&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=68&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=68&tipoRetorno=3\', \'idsHistoricoFiltroGenerico57\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico57CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico58'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico58 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 69);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico58CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico58); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico58[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico58[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico58[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico58CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico58" name="idsHistoricoFiltroGenerico58[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico58); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico58[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico58[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico58CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico58" name="idsHistoricoFiltroGenerico58[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico58); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico58[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico58[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico58))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=69&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=69&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=69&tipoRetorno=3\', \'idsHistoricoFiltroGenerico58\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico58CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico59'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico59 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 70);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico59CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico59); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico59[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico59[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico59[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico59CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico59" name="idsHistoricoFiltroGenerico59[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico59); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico59[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico59[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico59CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico59" name="idsHistoricoFiltroGenerico59[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico59); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico59[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico59[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico59))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=70&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=70&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=70&tipoRetorno=3\', \'idsHistoricoFiltroGenerico59\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico59CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico60'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico60 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 71);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico60); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico60[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico60[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico60[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico60" name="idsHistoricoFiltroGenerico60[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico60); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico60[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico60[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico60" name="idsHistoricoFiltroGenerico60[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico60); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico60[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico60[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico60))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=71&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=71&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=71&tipoRetorno=3\', \'idsHistoricoFiltroGenerico60\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico60CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico61'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico61 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 72);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico61CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico61); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico61[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico61[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico61[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico61CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico61" name="idsHistoricoFiltroGenerico61[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico61); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico61[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico61[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico61CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico61" name="idsHistoricoFiltroGenerico61[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico61); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico61[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico61[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico61))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=72&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=72&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=72&tipoRetorno=3\', \'idsHistoricoFiltroGenerico61\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico61CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico62'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico62 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 73);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico62CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico62); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico62[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico62[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico62[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico62CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico62" name="idsHistoricoFiltroGenerico62[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico62); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico62[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico62[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico62CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico62" name="idsHistoricoFiltroGenerico62[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico62); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico62[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico62[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico62))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=73&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=73&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=73&tipoRetorno=3\', \'idsHistoricoFiltroGenerico62\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico62CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico63'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico63 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 74);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico63CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico63); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico63[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico63[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico63[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico63CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico63" name="idsHistoricoFiltroGenerico63[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico63); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico63[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico63[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico63CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico63" name="idsHistoricoFiltroGenerico63[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico63); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico63[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico63[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico63))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=74&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=74&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=74&tipoRetorno=3\', \'idsHistoricoFiltroGenerico63\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico63CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico64'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico64 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 75);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico64CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico64); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico64[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico64[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico64[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico64CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico64" name="idsHistoricoFiltroGenerico64[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico64); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico64[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico64[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico64CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico64" name="idsHistoricoFiltroGenerico64[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico64); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico64[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico64[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico64))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=75&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=75&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=75&tipoRetorno=3\', \'idsHistoricoFiltroGenerico64\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico64CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico65'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico65 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 76);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico65CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico65); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico65[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico65[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico65[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico65CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico65" name="idsHistoricoFiltroGenerico65[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico65); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico65[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico65[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico65CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico65" name="idsHistoricoFiltroGenerico65[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico65); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico65[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico65[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico65))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=76&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=76&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=76&tipoRetorno=3\', \'idsHistoricoFiltroGenerico65\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico65CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico66'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico66 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 77);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico66CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico66); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico66[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico66[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico66[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico66CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico66" name="idsHistoricoFiltroGenerico66[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico66); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico66[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico66[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico66CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico66" name="idsHistoricoFiltroGenerico66[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico66); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico66[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico66[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico66))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=77&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=77&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=77&tipoRetorno=3\', \'idsHistoricoFiltroGenerico66\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico66CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico67'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico67 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 78);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico67CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico67); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico67[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico67[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico67[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico67CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico67" name="idsHistoricoFiltroGenerico67[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico67); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico67[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico67[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico67CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico67" name="idsHistoricoFiltroGenerico67[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico67); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico67[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico67[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico67))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=78&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=78&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=78&tipoRetorno=3\', \'idsHistoricoFiltroGenerico67\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico67CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico68'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico68 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 79);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico68CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico68); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico68[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico68[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico68[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico68CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico68" name="idsHistoricoFiltroGenerico68[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico68); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico68[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico68[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico68CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico68" name="idsHistoricoFiltroGenerico68[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico68); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico68[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico68[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico68))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=79&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=79&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=79&tipoRetorno=3\', \'idsHistoricoFiltroGenerico68\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico68CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico69'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico69 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 80);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico69CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico69); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico69[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico69[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico69[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico69CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico69" name="idsHistoricoFiltroGenerico69[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico69); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico69[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico69[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico69CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico69" name="idsHistoricoFiltroGenerico69[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico69); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico69[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico69[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico69))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=80&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=80&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=80&tipoRetorno=3\', \'idsHistoricoFiltroGenerico69\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico69CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico70'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico70 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 81);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico70CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico70); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico70[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico70[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico70[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico70CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico70" name="idsHistoricoFiltroGenerico70[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico70); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico70[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico70[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico70CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico70" name="idsHistoricoFiltroGenerico70[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico70); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico70[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico70[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico70))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=81&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=81&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=81&tipoRetorno=3\', \'idsHistoricoFiltroGenerico70\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico70CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico71'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico71 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 82);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico71CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico71); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico71[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico71[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico71[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico71CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico71" name="idsHistoricoFiltroGenerico71[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico71); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico71[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico71[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico71CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico71" name="idsHistoricoFiltroGenerico71[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico71); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico71[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico71[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico71))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=82&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=82&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=82&tipoRetorno=3\', \'idsHistoricoFiltroGenerico71\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico71CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico72'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico72 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 83);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico72CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico72); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico72[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico72[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico72[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico72CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico72" name="idsHistoricoFiltroGenerico72[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico72); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico72[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico72[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico72CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico72" name="idsHistoricoFiltroGenerico72[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico72); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico72[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico72[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico72))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=83&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=83&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=83&tipoRetorno=3\', \'idsHistoricoFiltroGenerico72\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico72CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico73'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico73 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 84);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico73CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico73); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico73[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico73[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico73[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico73CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico73" name="idsHistoricoFiltroGenerico73[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico73); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico73[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico73[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico73CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico73" name="idsHistoricoFiltroGenerico73[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico73); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico73[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico73[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico73))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=84&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=84&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=84&tipoRetorno=3\', \'idsHistoricoFiltroGenerico73\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico73CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico74'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico74 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 85);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico74CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico74); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico74[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico74[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico74[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico74CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico74" name="idsHistoricoFiltroGenerico74[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico74); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico74[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico74[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico74CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico74" name="idsHistoricoFiltroGenerico74[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico74); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico74[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico74[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico74))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=85&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=85&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=85&tipoRetorno=3\', \'idsHistoricoFiltroGenerico74\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico74CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico75'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico75 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 86);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico75CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico75); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico75[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico75[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico75[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico75CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico75" name="idsHistoricoFiltroGenerico75[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico75); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico75[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico75[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico75CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico75" name="idsHistoricoFiltroGenerico75[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico75); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico75[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico75[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico75))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=86&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=86&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=86&tipoRetorno=3\', \'idsHistoricoFiltroGenerico75\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico75CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico76'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico76 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 87);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico76CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico76); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico76[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico76[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico76[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico76CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico76" name="idsHistoricoFiltroGenerico76[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico76); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico76[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico76[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico76CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico76" name="idsHistoricoFiltroGenerico76[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico76); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico76[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico76[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico76))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=87&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=87&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=87&tipoRetorno=3\', \'idsHistoricoFiltroGenerico76\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico76CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico77'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico77 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 88);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico77CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico77); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico77[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico77[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico77[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico77CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico77" name="idsHistoricoFiltroGenerico77[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico77); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico77[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico77[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico77CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico77" name="idsHistoricoFiltroGenerico77[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico77); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico77[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico77[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico77))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=88&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=88&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=88&tipoRetorno=3\', \'idsHistoricoFiltroGenerico77\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico77CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico78'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico78 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 89);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico78CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico78); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico78[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico78[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico78[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico78CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico78" name="idsHistoricoFiltroGenerico78[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico78); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico78[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico78[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico78CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico78" name="idsHistoricoFiltroGenerico78[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico78); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico78[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico78[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico78))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=89&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=89&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=89&tipoRetorno=3\', \'idsHistoricoFiltroGenerico78\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico78CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico79'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico79 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 90);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico79CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico79); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico79[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico79[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico79[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico79CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico79" name="idsHistoricoFiltroGenerico79[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico79); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico79[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico79[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico79CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico79" name="idsHistoricoFiltroGenerico79[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico79); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico79[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico79[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico79))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=90&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=90&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=90&tipoRetorno=3\', \'idsHistoricoFiltroGenerico79\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico79CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoFiltroGenerico80'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>: 
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                            $arrHistoricoFiltroGenerico80 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 91);
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico80CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico80); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico80[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico80[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrHistoricoFiltroGenerico80[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico80CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico80" name="idsHistoricoFiltroGenerico80[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico80); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico80[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico80[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <br />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico80CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico80" name="idsHistoricoFiltroGenerico80[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico80); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico80[$countArray][0];?>"><?php echo $arrHistoricoFiltroGenerico80[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico80))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=91&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=91&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=91&tipoRetorno=3\', \'idsHistoricoFiltroGenerico80\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico80CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrHistoricoVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo1'], $GLOBALS['configIdTbTipoHistoricoVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo1'], $GLOBALS['configHistoricoVinculo1Metodo']);
                            ?>
                            <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoVinculo1); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrHistoricoVinculo1[$countArray][0];?>"><?php echo $arrHistoricoVinculo1[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrHistoricoVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo2'], $GLOBALS['configIdTbTipoHistoricoVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo2'], $GLOBALS['configHistoricoVinculo2Metodo']);
                            ?>
                            <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoVinculo2); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrHistoricoVinculo2[$countArray][0];?>"><?php echo $arrHistoricoVinculo2[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrHistoricoVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo3'], $GLOBALS['configIdTbTipoHistoricoVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo3'], $GLOBALS['configHistoricoVinculo3Metodo']);
                            ?>
                            <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoVinculo3); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrHistoricoVinculo3[$countArray][0];?>"><?php echo $arrHistoricoVinculo3[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarHistoricoIc1'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc2'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc3'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc4'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc5'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc6'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc6'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc6'] == 1){ ?>
    
                                <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc6'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
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
                                    <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc7'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc7'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc7'] == 1){ ?>
                                <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc7'] == 1){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
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
                                    <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc8'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc8'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc8'] == 1){ ?>
                                <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc8'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
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
                                    <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc9'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc9'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc9'] == 1){ ?>
                                <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc9'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
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
                                    <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc10'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc10'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc10'] == 1){ ?>
                                <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc10'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
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
                                    <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc11'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc11'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc11'] == 1){ ?>
                                <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc11'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
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
                                    <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc12'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc12'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc12'] == 1){ ?>
                                <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc12'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
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
                                    <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc13'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc13'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc13'] == 1){ ?>
                                <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc13'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
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
                                    <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc14'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc14'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc14'] == 1){ ?>
                                <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc14'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
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
                                    <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc15'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc15'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc15'] == 1){ ?>
                                <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc15'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
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
                                    <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc16'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc16'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc16'] == 1){ ?>
                                <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc16'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
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
                                    <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc17'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc17'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc17'] == 1){ ?>
                                <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc17'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
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
                                    <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc18'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc18'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc18'] == 1){ ?>
                                <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc18'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
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
                                    <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc19'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc19'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc19'] == 1){ ?>
                                <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc19'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
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
                                    <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc20'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc20'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc20'] == 1){ ?>
                                <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc20'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
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
                                    <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc21'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc21'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc21'] == 1){ ?>
                                <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc21'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
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
                                    <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc22'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc22'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc22'] == 1){ ?>
                                <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc22'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
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
                                    <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc23'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc23'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc23'] == 1){ ?>
                                <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc23'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
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
                                    <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc24'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc24'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc24'] == 1){ ?>
                                <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc24'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
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
                                    <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc25'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc25'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc25'] == 1){ ?>
                                <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc25'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
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
                                    <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc26'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc26'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc26'] == 1){ ?>
                                <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc26'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
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
                                    <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc27'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc27'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc27'] == 1){ ?>
                                <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc27'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
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
                                    <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc28'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc28'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc28'] == 1){ ?>
                                <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc28'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
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
                                    <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc29'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc29'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc29'] == 1){ ?>
                                <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc29'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
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
                                    <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc30'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc30'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc30'] == 1){ ?>
                                <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc30'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
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
                                    <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc31'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc31'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc31'] == 1){ ?>
                                <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc31'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
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
                                    <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc32'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc32'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc32'] == 1){ ?>
                                <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc32'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
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
                                    <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc33'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc33'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc33'] == 1){ ?>
                                <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc33'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
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
                                    <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc34'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc34'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc34'] == 1){ ?>
                                <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc34'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
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
                                    <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc35'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc35'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc35'] == 1){ ?>
                                <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc35'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
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
                                    <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc36'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc36'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc36'] == 1){ ?>
                                <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc36'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
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
                                    <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc37'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc37'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc37'] == 1){ ?>
                                <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc37'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
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
                                    <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc38'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc38'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc38'] == 1){ ?>
                                <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc38'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
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
                                    <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc39'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc39'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc39'] == 1){ ?>
                                <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc39'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
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
                                    <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc40'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc40'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc40'] == 1){ ?>
                                <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc40'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
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
                                    <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc41'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc41'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc41'] == 1){ ?>
                                <input type="text" name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc41'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar41").cleditor(
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
                                    <textarea name="informacao_complementar41" id="informacao_complementar41"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar41").cleditor(
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
                                    <textarea name="informacao_complementar41" id="informacao_complementar41"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc42'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc42'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc42'] == 1){ ?>
                                <input type="text" name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc42'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar42").cleditor(
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
                                    <textarea name="informacao_complementar42" id="informacao_complementar42"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar42").cleditor(
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
                                    <textarea name="informacao_complementar42" id="informacao_complementar42"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc43'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc43'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc43'] == 1){ ?>
                                <input type="text" name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc43'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar43").cleditor(
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
                                    <textarea name="informacao_complementar43" id="informacao_complementar43"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar43").cleditor(
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
                                    <textarea name="informacao_complementar43" id="informacao_complementar43"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc44'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc44'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc44'] == 1){ ?>
                                <input type="text" name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc44'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar44").cleditor(
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
                                    <textarea name="informacao_complementar44" id="informacao_complementar44"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar44").cleditor(
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
                                    <textarea name="informacao_complementar44" id="informacao_complementar44"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc45'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc45'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc45'] == 1){ ?>
                                <input type="text" name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc45'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar45").cleditor(
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
                                    <textarea name="informacao_complementar45" id="informacao_complementar45"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar45").cleditor(
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
                                    <textarea name="informacao_complementar45" id="informacao_complementar45"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc46'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc46'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc46'] == 1){ ?>
                                <input type="text" name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc46'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar46").cleditor(
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
                                    <textarea name="informacao_complementar46" id="informacao_complementar46"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar46").cleditor(
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
                                    <textarea name="informacao_complementar46" id="informacao_complementar46"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc47'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc47'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc47'] == 1){ ?>
                                <input type="text" name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc47'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar47").cleditor(
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
                                    <textarea name="informacao_complementar47" id="informacao_complementar47"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar47").cleditor(
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
                                    <textarea name="informacao_complementar47" id="informacao_complementar47"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc48'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc48'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc48'] == 1){ ?>
                                <input type="text" name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc48'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar48").cleditor(
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
                                    <textarea name="informacao_complementar48" id="informacao_complementar48"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar48").cleditor(
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
                                    <textarea name="informacao_complementar48" id="informacao_complementar48"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc49'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc49'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc49'] == 1){ ?>
                                <input type="text" name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc49'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar49").cleditor(
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
                                    <textarea name="informacao_complementar49" id="informacao_complementar49"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar49").cleditor(
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
                                    <textarea name="informacao_complementar49" id="informacao_complementar49"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc50'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc50'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc50'] == 1){ ?>
                                <input type="text" name="informacao_complementar50" id="informacao_complementar50" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc50'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar50" id="informacao_complementar50" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar50").cleditor(
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
                                    <textarea name="informacao_complementar50" id="informacao_complementar50"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar50").cleditor(
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
                                    <textarea name="informacao_complementar50" id="informacao_complementar50"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc51'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc51'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc51'] == 1){ ?>
                                <input type="text" name="informacao_complementar51" id="informacao_complementar51" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc51'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar51" id="informacao_complementar51" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar51").cleditor(
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
                                    <textarea name="informacao_complementar51" id="informacao_complementar51"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar51").cleditor(
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
                                    <textarea name="informacao_complementar51" id="informacao_complementar51"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc52'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc52'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc52'] == 1){ ?>
                                <input type="text" name="informacao_complementar52" id="informacao_complementar52" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc52'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar52" id="informacao_complementar52" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar52").cleditor(
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
                                    <textarea name="informacao_complementar52" id="informacao_complementar52"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar52").cleditor(
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
                                    <textarea name="informacao_complementar52" id="informacao_complementar52"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc53'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc53'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc53'] == 1){ ?>
                                <input type="text" name="informacao_complementar53" id="informacao_complementar53" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc53'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar53" id="informacao_complementar53" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar53").cleditor(
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
                                    <textarea name="informacao_complementar53" id="informacao_complementar53"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar53").cleditor(
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
                                    <textarea name="informacao_complementar53" id="informacao_complementar53"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc54'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc54'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc54'] == 1){ ?>
                                <input type="text" name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc54'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar54").cleditor(
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
                                    <textarea name="informacao_complementar54" id="informacao_complementar54"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar54").cleditor(
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
                                    <textarea name="informacao_complementar54" id="informacao_complementar54"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc55'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc55'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc55'] == 1){ ?>
                                <input type="text" name="informacao_complementar55" id="informacao_complementar55" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc55'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar55" id="informacao_complementar55" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar55").cleditor(
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
                                    <textarea name="informacao_complementar55" id="informacao_complementar55"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar55").cleditor(
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
                                    <textarea name="informacao_complementar55" id="informacao_complementar55"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc56'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc56'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc56'] == 1){ ?>
                                <input type="text" name="informacao_complementar56" id="informacao_complementar56" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc56'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar56" id="informacao_complementar56" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar56").cleditor(
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
                                    <textarea name="informacao_complementar56" id="informacao_complementar56"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar56").cleditor(
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
                                    <textarea name="informacao_complementar56" id="informacao_complementar56"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarHistoricoIc57'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc57'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc57'] == 1){ ?>
                                <input type="text" name="informacao_complementar57" id="informacao_complementar57" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc57'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar57" id="informacao_complementar57" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar57").cleditor(
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
                                    <textarea name="informacao_complementar57" id="informacao_complementar57"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar57").cleditor(
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
                                    <textarea name="informacao_complementar57" id="informacao_complementar57"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc58'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc58'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc58'] == 1){ ?>
                                <input type="text" name="informacao_complementar58" id="informacao_complementar58" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc58'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar58" id="informacao_complementar58" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar58").cleditor(
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
                                    <textarea name="informacao_complementar58" id="informacao_complementar58"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar58").cleditor(
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
                                    <textarea name="informacao_complementar58" id="informacao_complementar58"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc59'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc59'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc59'] == 1){ ?>
                                <input type="text" name="informacao_complementar59" id="informacao_complementar59" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc59'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar59" id="informacao_complementar59" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar59").cleditor(
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
                                    <textarea name="informacao_complementar59" id="informacao_complementar59"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar59").cleditor(
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
                                    <textarea name="informacao_complementar59" id="informacao_complementar59"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarHistoricoIc60'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc60'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configHistoricoBoxIc60'] == 1){ ?>
                                <input type="text" name="informacao_complementar60" id="informacao_complementar60" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoBoxIc60'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar60" id="informacao_complementar60" class="AdmCampoTextoMultilinha01"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar60").cleditor(
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
                                    <textarea name="informacao_complementar60" id="informacao_complementar60"></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar60").cleditor(
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
                                    <textarea name="informacao_complementar60" id="informacao_complementar60"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroHistoricoUsuario'] == 1){ ?>
                <tr<?php if($idTbCadastroUsuarioSelect <> ""){ ?> style="display: none;"<?php } ?>>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
							$arrHistoricoCadastroUsuario = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                            ?>
                            <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoCadastroUsuario); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrHistoricoCadastroUsuario[$countArray][0];?>"<?php if($idTbCadastroUsuarioSelect == $arrHistoricoCadastroUsuario[$countArray][0]){?> selected="selected"<?php } ?>><?php echo $arrHistoricoCadastroUsuario[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
                <tr<?php if($idTbHistoricoStatusSelect <> ""){ ?> style="display: none;"<?php } ?>>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
							$arrHistoricoStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 4);
                            ?>
                            <select name="id_tb_historico_status" id="id_tb_historico_status" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoStatus); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrHistoricoStatus[$countArray][0];?>"<?php if($idTbHistoricoStatusSelect == $arrHistoricoStatus[$countArray][0]){?> selected="selected"<?php } ?>><?php echo $arrHistoricoStatus[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
    
        </div>
        <div>
            <div style="float:left;">
            	<?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> "" || CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario2") <> "" || CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario3") <> ""){ ?>
                    <div class="AdmDivBto01" onclick="btoClick_onEvent('btoHistoricoIncluir');" style="margin-top: 0px;">
                        <a class="AdmLinks01">
                            Incluir Tratamento
                        </a>
                    </div>
                
                    <input id="btoHistoricoIncluir" type="image" name="submit" value="Submit" src="img/btoIncluirTratamento.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" style="display: none;" />
                <?php } ?>
                
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $idParent; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                
                <input name="idTbCadastroUsuarioSelect" type="hidden" id="idTbCadastroUsuarioSelect" value="<?php echo $idTbCadastroUsuarioSelect; ?>" />
                <input name="idTbHistoricoStatusSelect" type="hidden" id="idTbHistoricoStatusSelect" value="<?php echo $idTbHistoricoStatusSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
    
    
    <?php //Manutenção - Ajax.?>
    <div id="divManutencaoAjax" class="AdmDivPopupAjaxContainer" style="">
        <div class="AdmDivPopupAjax" style="">
        	<div style="position: absolute; display: block; height: 25px; top: -25px; right: 0px;">
            	<a id="linkManutencaoAjaxFechar" onclick="" class="AdmLinksFechar01" style="cursor: pointer;">
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
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>
<?php
//Limpeza de objetos.
//----------
unset($strSqlHistoricoSelect);
unset($statementHistoricoSelect);
unset($resultadoHistorico);
unset($linhaHistorico);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>