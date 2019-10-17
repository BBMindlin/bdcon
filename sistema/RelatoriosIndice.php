<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$tipoRelatorio = $_GET["tipoRelatorio"];
//$tipoRelatorio = "cadastro";

$idTbCadastro1 = $_GET["idTbCadastro1"];
//$idTbUsuarios = $_GET["idTbUsuarios"];
//$idTbUsuarios = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuario']], 2), 2);
$ativacao = $_GET["ativacao"];

$dataAtual = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$paginaRetorno = "RelatoriosIndice.php";
$paginaRetornoExclusao = "RelatoriosIndice.php";
//$variavelRetorno = "idTbUsuarios";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Critério classificação.
$dataInicial = $_GET["dataInicial"];
$dataFinal = $_GET["dataFinal"];
$dataInicialConvert = strtotime(Funcoes::DataGravacaoSql($dataInicial, $GLOBALS['configSiteFormatoData']));
$dataFinalConvert = strtotime(Funcoes::DataGravacaoSql($dataFinal, $GLOBALS['configSiteFormatoData']));

if($dataInicial <> "")
{
	$diaDataInicial = date('d', $dataInicialConvert);
	$mesDataInicial = date('m', $dataInicialConvert);
	$anoDataInicial = date('Y', $dataInicialConvert);
	
	$dataInicial_print = Funcoes::DataLeitura01($anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial, $GLOBALS['configSiteFormatoData'], "1");
}else{
	//$dataInicial_print = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");
	$dataInicial_print = "";
}
if($dataFinal <> "")
{
	$diaDataFinal = date('d', $dataFinalConvert);
	$mesDataFinal = date('m', $dataFinalConvert);
	$anoDataFinal = date('Y', $dataFinalConvert);
	
	$dataFinal_print = Funcoes::DataLeitura01($anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal, $GLOBALS['configSiteFormatoData'], "1");
}else{
	//$dataFinal_print = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");
	$dataFinal_print = "";
}


//Montagem de query padrão de retorno.
//"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
//"&variavelRetorno=" . $variavelRetorno
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&dataInicial=" . $dataInicial . 
"&dataFinal=" . $dataFinal . 
"&idTbCadastro1=" . $idTbCadastro1 . 
"&tipoRelatorio=" . $tipoRelatorio;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.
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
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaRelatoriosTitulo"); ?>
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

        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    
	<?php //Filtros.?>
    <?php //**************************************************************************************?>
    <div style="position: relative; display: block; overflow: hidden;">
        <form name="formRelatoriosFiltros" id="formRelatoriosFiltros" action="RelatoriosIndice.php" method="get" class="FormularioTabela01">
        	<?php //Obs: Colocar uma seleção, futuramente.?>
            <input name="tipoRelatorio" type="hidden" id="tipoRelatorio" value="aulas">
            
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            
            <table width="100%" class="TabelaDados01">
                <tr class="TbFundoEscuro">
                    <td class="TbFundoEscuro TabelaDados01Celula" colspan="4">
                        <div align="center" class="Texto02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPeriodo"); ?> 
                        </div>
                    </td>
                </tr>
                  
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaDataInicial"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#dataInicial;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#dataInicial;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="dataInicial" id="dataInicial" class="CampoData01" maxlength="10" value="<?php echo $dataInicial_print;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaDataFinal"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaColuna01">
                        <div>
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#dataFinal;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#dataFinal;";
                                    </script>
                                <?php } ?>
                            
                                <input type="text" name="dataFinal" id="dataFinal" class="CampoData01" maxlength="10" value="<?php echo $dataFinal_print;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNome"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">

                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                                <option value=""<?php if($ativacao == ""){?> selected="selected"<?php }?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"<?php if($ativacao == "0"){?> selected="selected"<?php }?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                                <option value="1"<?php if($ativacao == "1"){?> selected="selected"<?php }?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoAplicar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAplicar"); ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
    </div>
    <?php //**************************************************************************************?>


	<?php //Relatórios - Informações.?>
    <?php //**************************************************************************************?>
    <?php if($idTbCadastro1 <> ""){?>
    <div class="Texto01" style="position: relative; display: block; overflow: hidden; margin-top: 20px;">
        <div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBuscaPeriodo"); ?>:
            </strong>
            <?php echo $mesDataInicial; ?> / <?php echo $anoDataInicial; ?>
        </div>
        <div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNome"); ?>:
            </strong>
            <?php //echo DbFuncoes::GetCampoGenerico01($idTbCadastro1, "tb_cadastro", "nome"); ?>
        </div>
    </div>
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
	<?php //Relatórios - Cadastro.?>
    <?php //**************************************************************************************?>
    <?php if($tipoRelatorio == "cadastro"){ ?>
    <?php
	//Variáveis.
	$idParentCadastro = $_GET["idParentCadastro"];
	$idParentCadastro = "3479";
	$strSeparador = ";";
	
	
	//Query de pesquisa.
	//----------
	$strSqlCadastroSelect = "";
	$strSqlCadastroSelect .= "SELECT ";
	//$strSqlCadastroSelect .= "SELECT SQL_CALC_FOUND_ROWS ";
	$strSqlCadastroSelect .= "id, ";
	$strSqlCadastroSelect .= "id_tb_categorias, ";
	//$strSqlCadastroSelect .= "id_parent_cadastro, ";
	$strSqlCadastroSelect .= "data_cadastro, ";
	$strSqlCadastroSelect .= "pf_pj, ";
	$strSqlCadastroSelect .= "nome, ";
	$strSqlCadastroSelect .= "sexo, ";
	$strSqlCadastroSelect .= "altura, ";
	$strSqlCadastroSelect .= "peso, ";
	$strSqlCadastroSelect .= "razao_social, ";
	$strSqlCadastroSelect .= "nome_fantasia, ";
	
	$strSqlCadastroSelect .= "data_nascimento, ";
	$strSqlCadastroSelect .= "data1, ";
	$strSqlCadastroSelect .= "data2, ";
	$strSqlCadastroSelect .= "data3, ";
	$strSqlCadastroSelect .= "data4, ";
	$strSqlCadastroSelect .= "data5, ";
	$strSqlCadastroSelect .= "data6, ";
	$strSqlCadastroSelect .= "data7, ";
	$strSqlCadastroSelect .= "data8, ";
	$strSqlCadastroSelect .= "data9, ";
	$strSqlCadastroSelect .= "data10, ";
	
	$strSqlCadastroSelect .= "cpf_, ";
	$strSqlCadastroSelect .= "rg_, ";
	$strSqlCadastroSelect .= "cnpj_, ";
	$strSqlCadastroSelect .= "documento, ";
	$strSqlCadastroSelect .= "i_municipal, ";
	$strSqlCadastroSelect .= "i_estadual, ";
	
	$strSqlCadastroSelect .= "endereco_principal, ";
	$strSqlCadastroSelect .= "endereco_numero_principal, ";
	$strSqlCadastroSelect .= "endereco_complemento_principal, ";
	$strSqlCadastroSelect .= "bairro_principal, ";
	$strSqlCadastroSelect .= "cidade_principal, ";
	$strSqlCadastroSelect .= "estado_principal, ";
	$strSqlCadastroSelect .= "pais_principal, ";
	$strSqlCadastroSelect .= "cep_principal, ";
	
	$strSqlCadastroSelect .= "ponto_referencia, ";
	$strSqlCadastroSelect .= "email_principal, ";
	$strSqlCadastroSelect .= "tel_ddd_principal, ";
	$strSqlCadastroSelect .= "tel_principal, ";
	$strSqlCadastroSelect .= "cel_ddd_principal, ";
	$strSqlCadastroSelect .= "cel_principal, ";
	$strSqlCadastroSelect .= "fax_ddd_principal, ";
	$strSqlCadastroSelect .= "fax_principal, ";
	$strSqlCadastroSelect .= "site_principal, ";
	$strSqlCadastroSelect .= "n_funcionarios, ";
	$strSqlCadastroSelect .= "obs_interno, ";
	$strSqlCadastroSelect .= "id_tb_cadastro_status, ";
	//$strSqlCadastroSelect .= "id_tb_cadastro, ";
	$strSqlCadastroSelect .= "id_tb_cadastro1, ";
	$strSqlCadastroSelect .= "id_tb_cadastro2, ";
	$strSqlCadastroSelect .= "id_tb_cadastro3, ";
	$strSqlCadastroSelect .= "ativacao, ";
	$strSqlCadastroSelect .= "ativacao_destaque, ";
	$strSqlCadastroSelect .= "ativacao_mala_direta, ";
	$strSqlCadastroSelect .= "usuario, ";
	$strSqlCadastroSelect .= "senha, ";
	
	$strSqlCadastroSelect .= "imagem, ";
	$strSqlCadastroSelect .= "logo, ";
	$strSqlCadastroSelect .= "banner, ";
	$strSqlCadastroSelect .= "mapa, ";
	
	$strSqlCadastroSelect .= "mapa_online, ";
	$strSqlCadastroSelect .= "palavras_chave, ";
	$strSqlCadastroSelect .= "apresentacao, ";
	$strSqlCadastroSelect .= "servicos, ";
	$strSqlCadastroSelect .= "promocoes, ";
	$strSqlCadastroSelect .= "condicoes_comerciais, ";
	$strSqlCadastroSelect .= "formas_pagamento, ";
	$strSqlCadastroSelect .= "horario_atendimento, ";
	$strSqlCadastroSelect .= "situacao_atual, ";
	
	$strSqlCadastroSelect .= "informacao_complementar1, ";
	$strSqlCadastroSelect .= "informacao_complementar2, ";
	$strSqlCadastroSelect .= "informacao_complementar3, ";
	$strSqlCadastroSelect .= "informacao_complementar4, ";
	$strSqlCadastroSelect .= "informacao_complementar5, ";
	$strSqlCadastroSelect .= "informacao_complementar6, ";
	$strSqlCadastroSelect .= "informacao_complementar7, ";
	$strSqlCadastroSelect .= "informacao_complementar8, ";
	$strSqlCadastroSelect .= "informacao_complementar9, ";
	$strSqlCadastroSelect .= "informacao_complementar10, ";
	$strSqlCadastroSelect .= "informacao_complementar11, ";
	$strSqlCadastroSelect .= "informacao_complementar12, ";
	$strSqlCadastroSelect .= "informacao_complementar13, ";
	$strSqlCadastroSelect .= "informacao_complementar14, ";
	$strSqlCadastroSelect .= "informacao_complementar15, ";
	$strSqlCadastroSelect .= "informacao_complementar16, ";
	$strSqlCadastroSelect .= "informacao_complementar17, ";
	$strSqlCadastroSelect .= "informacao_complementar18, ";
	$strSqlCadastroSelect .= "informacao_complementar19, ";
	$strSqlCadastroSelect .= "informacao_complementar20, ";
	$strSqlCadastroSelect .= "informacao_complementar21, ";
	$strSqlCadastroSelect .= "informacao_complementar22, ";
	$strSqlCadastroSelect .= "informacao_complementar23, ";
	$strSqlCadastroSelect .= "informacao_complementar24, ";
	$strSqlCadastroSelect .= "informacao_complementar25, ";
	$strSqlCadastroSelect .= "informacao_complementar26, ";
	$strSqlCadastroSelect .= "informacao_complementar27, ";
	$strSqlCadastroSelect .= "informacao_complementar28, ";
	$strSqlCadastroSelect .= "informacao_complementar29, ";
	$strSqlCadastroSelect .= "informacao_complementar30, ";
	$strSqlCadastroSelect .= "informacao_complementar31, ";
	$strSqlCadastroSelect .= "informacao_complementar32, ";
	$strSqlCadastroSelect .= "informacao_complementar33, ";
	$strSqlCadastroSelect .= "informacao_complementar34, ";
	$strSqlCadastroSelect .= "informacao_complementar35, ";
	$strSqlCadastroSelect .= "informacao_complementar36, ";
	$strSqlCadastroSelect .= "informacao_complementar37, ";
	$strSqlCadastroSelect .= "informacao_complementar38, ";
	$strSqlCadastroSelect .= "informacao_complementar39, ";
	$strSqlCadastroSelect .= "informacao_complementar40, ";
	$strSqlCadastroSelect .= "n_visitas ";
	
	$strSqlCadastroSelect .= "FROM tb_cadastro ";
	$strSqlCadastroSelect .= "WHERE id <> 0 ";
	if($idParentCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($idsTdCadastro <> "")
	{
		//$strSqlCadastroSelect .= "AND id IN (:idsTdCadastro) ";
		$strSqlCadastroSelect .= "AND id IN ( " . Funcoes::ConteudoMascaraGravacao01($idsTdCadastro) . ") ";
		//$strSqlCadastroSelect .= "AND id IN :idsTdCadastro ";
	}
	if($palavraChave <> "")
	{
		
		///*
		$strSqlCadastroSelect .= "AND (nome LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		///*
		$strSqlCadastroSelect .= "OR razao_social LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR nome_fantasia LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cpf_ LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR rg_ LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cnpj_ LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR endereco_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR endereco_numero_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR endereco_complemento_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR bairro_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cidade_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR estado_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR pais_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cep_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR email_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR tel_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR cel_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR fax_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR site_principal LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR obs_interno LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR apresentacao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR servicos LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR promocoes LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR condicoes_comerciais LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR formas_pagamento LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR horario_atendimento LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR situacao_atual LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlCadastroSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		//*/
		$strSqlCadastroSelect .= ") ";
		//*/
	}
	
	//$strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
	if($GLOBALS['habilitarCadastroClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCadastro) <> "")
	{
		$strSqlCadastroSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentCadastro) . " ";
		
	}else{
		$strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
	}
	
	//echo "strSqlCadastroSelect=" . $strSqlCadastroSelect . "<br />";
	//----------
	
	
	//Parâmetros e componentes.
	//----------
	$statementCadastroSelect = $dbSistemaConPDO->prepare($strSqlCadastroSelect);
	
	if ($statementCadastroSelect !== false)
	{
		/*
		$statementCadastroSelect->bindParam(':id_tb_categorias', $idParentCadastro, PDO::PARAM_STR);
		//$statementCadastroSelect->bindParam(':idsTdCadastro', $idsTdCadastro, PDO::PARAM_STR);
		//$statementCadastroSelect->bindParam(':idsTdCadastro', array($idsTdCadastro), PDO::PARAM_STR);
		//$statementCadastroSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
		$statementCadastroSelect->execute();
		*/
		///*
		//"idsTdCadastro" => $idsTdCadastro
		if($idParentCadastro <> "")
		{
			$statementCadastroSelect->bindParam(':id_tb_categorias', $idParentCadastro, PDO::PARAM_STR);
		}
		$statementCadastroSelect->execute();
		/*
		$statementCadastroSelect->execute(array(
			"id_tb_categorias" => $idParentCadastro
		));
		*/
	}
	
	//$resultadoCadastro = $dbSistemaConPDO->query($strSqlCadastroSelect);
	$resultadoCadastro = $statementCadastroSelect->fetchAll();
	//----------
	
	?>
    <?php
	if (empty($resultadoCadastro))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
    	<?php //Diagramação 02 - sem tabela - exportação.?>
        <div class="Texto01" style="position: relative; display: block; overflow: hidden;">
			<?php ob_start(); /* exportacao*/?>
            
        	<?php
			//Filtro genérico.
			$arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
			$arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
			$arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
			$arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
			$arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
			$arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
			$arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
			$arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
			$arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
			$arrCadastroFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 21);
			
			/*
			$arrCadastro = DbFuncoes::GetCampoGenerico06("tb_turmas", 
														"id", 
														"id_tb_cadastro2", 
														$idTbCadastro1, 
														"", 
														"", 
														1, 
														"", 
														"", 
														"ativacao", 
														"1", 
														"", 
														"");
														*/


			//Impressão de colunas.
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemId") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroDataCadastro") . $strSeparador;
			
			if($GLOBALS['habilitarCadastroData1'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData1'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroData2'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData2'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroData3'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData3'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroData4'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData4'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroData5'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData5'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroData6'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData6'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroData7'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData7'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroData8'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData8'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroData9'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData9'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroData10'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroData10'], "IncludeConfig") . $strSeparador;
			}
			
			if($GLOBALS['habilitarCadastroPfPj'] == 1){
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPfPj") . $strSeparador;
			}
			
			if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig") . $strSeparador;
			}
			
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNome") . $strSeparador;
			if($GLOBALS['habilitarCadastroSexo'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSexo") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroAlturaPeso'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAltura") . $strSeparador;
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPeso") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroRazaoSocial'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRazaoSocial") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroNomeFantasia'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNomeFantasia") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroDataNascimento'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroDataNascimento") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroCPFRG'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPF") . $strSeparador;
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRG") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroCNPJ'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJ") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroDocumento'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroDocumento") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoMunicipal") . $strSeparador;
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoEstadual") . $strSeparador;
			}

            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoPrincipal") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoNumeroPrincipal") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoComplementoPrincipal") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBairroPrincipal") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCidadePrincipal") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEstadoPrincipal") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPaisPrincipal") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCEPPrincipal") . $strSeparador;
			
			if($GLOBALS['habilitarCadastroPontoReferencia'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPontoReferencia") . $strSeparador;
			}
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEmailPrincipal") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTel") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCel") . $strSeparador;
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFax") . $strSeparador;
			
			if($GLOBALS['habilitarCadastroSite'] == 1)
			{
	            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSitePrincipal") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroNFuncionarios'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNFuncionarios") . $strSeparador;
			}
            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroObs") . $strSeparador;
			if($GLOBALS['habilitarCadastroStatus'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroStatus") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtivacaoMalaDireta") . $strSeparador;
			}

			if($GLOBALS['habilitarCadastroVinculo1'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroVinculo2'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo2Nome'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroVinculo3'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo3Nome'], "IncludeConfig") . $strSeparador;
			}

            echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3") . $strSeparador;
			if($GLOBALS['habilitarCadastroAtivacaoDestaque'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroAtivacaoDestaque") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroUsuario'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroUsuario") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroSenha'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSenha") . $strSeparador;
			}
			
			if($GLOBALS['habilitarCadastroImagem'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroLogo'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroLogo") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroBanner'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBanner") . $strSeparador;
			}	
			if($GLOBALS['habilitarCadastroMapa'] == 1){
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroMapaImagem") . $strSeparador;
			}	
			
			if($GLOBALS['habilitarCadastroMapaOnline'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroMapaOnline") . $strSeparador;
			}	
			if($GLOBALS['habilitarCadastroPalavrasChave'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave01") . $strSeparador;	
			}	
			if($GLOBALS['habilitarCadastroApresentacao'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroApresentacao") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroServicos'] == 1)
			{	
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroServicos") . $strSeparador;
			}
			if($GLOBALS['HabilitarCadastroPromocoes'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPromocoes") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCondicoesComerciais") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroFormasPagamento'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFormasPagamento") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroHorarioAtendimento") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1)
			{
				echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSituacaoAtual") . $strSeparador;
			}

			if($GLOBALS['habilitarCadastroIc1'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc2'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc2'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc3'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc3'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc4'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc4'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc5'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc5'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc6'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc6'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc7'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc7'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc8'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc8'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc9'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc9'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc10'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc10'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc11'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc11'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc12'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc12'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc13'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc13'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc14'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc14'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc15'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc15'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc16'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc16'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc17'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc17'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc18'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc18'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc19'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc19'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc20'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc20'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc21'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc21'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc22'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc22'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc23'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc23'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc24'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc24'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc25'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc25'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc26'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc26'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc27'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc27'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc28'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc28'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc29'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc29'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc30'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc30'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc31'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc31'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc32'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc32'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc33'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc33'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc34'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc34'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc35'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc35'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc36'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc36'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc37'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc37'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc38'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc38'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc39'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc39'], "IncludeConfig") . $strSeparador;
			}
			if($GLOBALS['habilitarCadastroIc40'] == 1)
			{
				echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc40'], "IncludeConfig") . $strSeparador;
			}

			echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNVisivas") . $strSeparador;
			echo "<br />";
			?>
            
			<?php
            //Loop pelos resultados.
            foreach($resultadoCadastro as $linhaCadastro)
            {
				//Definição das variáveis de detalhes.
				$tbCadastroId = $linhaCadastro['id'];
				$tbCadastroDataCadastro = $linhaCadastro['data_cadastro'];
				$tbCadastroIdTbCategorias = $linhaCadastro['id_tb_categorias'];
				
				if($GLOBALS['habilitarCadastroData1'] == 1)
				{
					if($linhaCadastro['data1'] == NULL)
					{
						$tbCadastroData1 = "";
					}else{
						$tbCadastroData1 = Funcoes::DataLeitura01($linhaCadastro['data1'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroData2'] == 1)
				{
					if($linhaCadastro['data2'] == NULL)
					{
						$tbCadastroData2 = "";
					}else{
						$tbCadastroData2 = Funcoes::DataLeitura01($linhaCadastro['data2'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroData3'] == 1)
				{
					if($linhaCadastro['data3'] == NULL)
					{
						$tbCadastroData3 = "";
					}else{
						$tbCadastroData3 = Funcoes::DataLeitura01($linhaCadastro['data3'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroData4'] == 1)
				{
					if($linhaCadastro['data4'] == NULL)
					{
						$tbCadastroData4 = "";
					}else{
						$tbCadastroData4 = Funcoes::DataLeitura01($linhaCadastro['data4'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroData5'] == 1)
				{
					if($linhaCadastro['data5'] == NULL)
					{
						$tbCadastroData5 = "";
					}else{
						$tbCadastroData5 = Funcoes::DataLeitura01($linhaCadastro['data5'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroData6'] == 1)
				{
					if($linhaCadastro['data6'] == NULL)
					{
						$tbCadastroData6 = "";
					}else{
						$tbCadastroData6 = Funcoes::DataLeitura01($linhaCadastro['data6'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroData7'] == 1)
				{
					if($linhaCadastro['data7'] == NULL)
					{
						$tbCadastroData7 = "";
					}else{
						$tbCadastroData7 = Funcoes::DataLeitura01($linhaCadastro['data7'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroData8'] == 1)
				{
					if($linhaCadastro['data8'] == NULL)
					{
						$tbCadastroData8 = "";
					}else{
						$tbCadastroData8 = Funcoes::DataLeitura01($linhaCadastro['data8'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroData9'] == 1)
				{
					if($linhaCadastro['data9'] == NULL)
					{
						$tbCadastroData9 = "";
					}else{
						$tbCadastroData9 = Funcoes::DataLeitura01($linhaCadastro['data9'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroData10'] == 1)
				{
					if($linhaCadastro['data10'] == NULL)
					{
						$tbCadastroData10 = "";
					}else{
						$tbCadastroData10 = Funcoes::DataLeitura01($linhaCadastro['data10'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				
				if($GLOBALS['habilitarCadastroPfPj'] == 1){
					$tbCadastroPfPj = $linhaCadastro['pf_pj'];
				}
				
				if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1)
				{
                    $arrCadastroFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "12", "", ",", "", "1"));
					
					$tbCadastroFiltroGenerico01 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrCadastroFiltroGenerico01Selecao)){
							$tbCadastroFiltroGenerico01 = $tbCadastroFiltroGenerico01 . ", " . $arrCadastroFiltroGenerico01[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico01 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico01);
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1)
				{
                    $arrCadastroFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "13", "", ",", "", "1"));
					$tbCadastroFiltroGenerico02 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrCadastroFiltroGenerico02Selecao)){
							$tbCadastroFiltroGenerico02 = $tbCadastroFiltroGenerico02 . ", " . $arrCadastroFiltroGenerico02[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico02 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico02);
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1)
				{
                    $arrCadastroFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "14", "", ",", "", "1"));
					$tbCadastroFiltroGenerico03 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrCadastroFiltroGenerico03Selecao)){
							$tbCadastroFiltroGenerico03 = $tbCadastroFiltroGenerico03 . ", " . $arrCadastroFiltroGenerico03[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico03 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico03);
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1)
				{
                    $arrCadastroFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "15", "", ",", "", "1"));
					$tbCadastroFiltroGenerico04 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrCadastroFiltroGenerico04Selecao)){
							$tbCadastroFiltroGenerico04 = $tbCadastroFiltroGenerico04 . ", " . $arrCadastroFiltroGenerico04[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico02 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico02);
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1)
				{
                    $arrCadastroFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "16", "", ",", "", "1"));
					$tbCadastroFiltroGenerico05 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrCadastroFiltroGenerico05Selecao)){
							$tbCadastroFiltroGenerico05 = $tbCadastroFiltroGenerico05 . ", " . $arrCadastroFiltroGenerico05[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico05 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico05);
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1)
				{
                    $arrCadastroFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "17", "", ",", "", "1"));
					$tbCadastroFiltroGenerico06 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrCadastroFiltroGenerico06Selecao)){
							$tbCadastroFiltroGenerico06 = $tbCadastroFiltroGenerico06 . ", " . $arrCadastroFiltroGenerico06[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico06 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico06);
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1)
				{
                    $arrCadastroFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "18", "", ",", "", "1"));
					$tbCadastroFiltroGenerico07 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrCadastroFiltroGenerico07Selecao)){
							$tbCadastroFiltroGenerico07 = $tbCadastroFiltroGenerico07 . ", " . $arrCadastroFiltroGenerico07[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico07 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico07);
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1)
				{
					$arrCadastroFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "19", "", ",", "", "1"));
					$tbCadastroFiltroGenerico08 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrCadastroFiltroGenerico08Selecao)){
							$tbCadastroFiltroGenerico08 = $tbCadastroFiltroGenerico08 . ", " . $arrCadastroFiltroGenerico08[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico08 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico08);
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1)
				{
					$arrCadastroFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "20", "", ",", "", "1"));
					$tbCadastroFiltroGenerico09 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrCadastroFiltroGenerico09Selecao)){
							$tbCadastroFiltroGenerico09 = $tbCadastroFiltroGenerico09 . ", " . $arrCadastroFiltroGenerico09[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico09 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico09);
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1)
				{
					$arrCadastroFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "21", "", ",", "", "1"));
					$tbCadastroFiltroGenerico10 = "";
                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                    {
						if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrCadastroFiltroGenerico10Selecao)){
							$tbCadastroFiltroGenerico10 = $tbCadastroFiltroGenerico10 . ", " . $arrCadastroFiltroGenerico10[$countArray][1];
						}
                    }
					$tbCadastroFiltroGenerico10 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico10);
				}
				
				$tbCadastroNome = Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']);
				if($GLOBALS['habilitarCadastroSexo'] == 1)
				{
					$tbCadastroSexo = $linhaCadastro['sexo'];
				}
				if($GLOBALS['habilitarCadastroAlturaPeso'] == 1)
				{
					$tbCadastroAltura = $linhaCadastro['altura'];
					$tbCadastroPeso = $linhaCadastro['peso'];
				}
				if($GLOBALS['habilitarCadastroRazaoSocial'] == 1)
				{
					$tbCadastroRazaoSocial = Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']);
				}
				if($GLOBALS['habilitarCadastroNomeFantasia'] == 1)
				{
					$tbCadastroNomeFantasia = Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']);
				}
				if($GLOBALS['habilitarCadastroDataNascimento'] == 1)
				{
					if($linhaCadastro['data_nascimento'] == NULL)
					{
						$tbCadastroDataNascimento = "";
					}else{
						$tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastro['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
					}
				}
				if($GLOBALS['habilitarCadastroCPFRG'] == 1)
				{
					$tbCadastroCPF = Funcoes::FormatarCPFLer($linhaCadastro['cpf_']);
					$tbCadastroRG = $linhaCadastro['rg_'];
				}
				if($GLOBALS['habilitarCadastroCNPJ'] == 1)
				{
					$tbCadastroCNPJ = Funcoes::FormatarCNPJLer($linhaCadastro['cnpj_']);
				}
				if($GLOBALS['habilitarCadastroDocumento'] == 1)
				{
					$tbCadastroDocumento = $linhaCadastro['documento'];
				}
				if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1)
				{
					$tbCadastroIMunicipal = $linhaCadastro['i_municipal'];
					$tbCadastroIEstadual = $linhaCadastro['i_estadual'];
				}
	
				$tbCadastroEnderecoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_principal']);
				$tbCadastroEnderecoNumeroPrincipal = $linhaCadastro['endereco_numero_principal'];
				$tbCadastroEnderecoComplementoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['endereco_complemento_principal']);
				$tbCadastroBairroPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['bairro_principal']);
				$tbCadastroCidadePrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['cidade_principal']);
				$tbCadastroEstadoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['estado_principal']);
				$tbCadastroPaisPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastro['pais_principal']);
				
				$tbCadastroIdDBCepTblBairros = $linhaCadastro['id_db_cep_tblBairros'];
				$tbCadastroIdDBCepTblCidades = $linhaCadastro['id_db_cep_tblCidades'];
				$tbCadastroIdDBCepTblLogradouros = $linhaCadastro['id_db_cep_tblLogradouros'];
				$tbCadastroIdDBCepTblUF = $linhaCadastro['id_db_cep_tblUF'];
	
				$tbCadastroCepPrincipal = Funcoes::FormatarCEPLer($linhaCadastro['cep_principal']);
				
				if($GLOBALS['habilitarCadastroPontoReferencia'] == 1)
				{
					$tbCadastroPontoReferencia = Funcoes::ConteudoMascaraLeitura($linhaCadastro['ponto_referencia']);
				}
				$tbCadastroEmailPrincipal = $linhaCadastro['email_principal'];
				$tbCadastroTelDDDPrincipal = $linhaCadastro['tel_ddd_principal'];
				$tbCadastroTelPrincipal = $linhaCadastro['tel_principal'];
				$tbCadastroCelDDDPrincipal = $linhaCadastro['cel_ddd_principal'];
				$tbCadastroCelPrincipal = $linhaCadastro['cel_principal'];
				$tbCadastroFaxDDDPrincipal = $linhaCadastro['fax_ddd_principal'];
				$tbCadastroFaxPrincipal = $linhaCadastro['fax_principal'];
				
				if($GLOBALS['habilitarCadastroSite'] == 1)
				{
					$tbCadastroSitePrincipal = $linhaCadastro['site_principal'];
				}
				if($GLOBALS['habilitarCadastroNFuncionarios'] == 1)
				{
					$tbCadastroNFuncionarios = $linhaCadastro['n_funcionarios'];
				}
				$tbCadastroOBSInterno = Funcoes::ConteudoMascaraLeitura($linhaCadastro['obs_interno']);
				if($GLOBALS['habilitarCadastroStatus'] == 1)
				{
					$tbCadastroIdTbCadastroStatus = $linhaCadastro['id_tb_cadastro_status'];
					$tbCadastroIdTbCadastroStatus_print = DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastroStatus, "tb_cadastro_complemento", "complemento");
				}
				if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1)
				{
					$tbCadastroAtivacaoMalaDireta = $linhaCadastro['ativacao_mala_direta'];
				}
	
				if($GLOBALS['habilitarCadastroVinculo1'] == 1)
				{
					$tbCadastroIdTbCadastro1 = $linhaCadastro['id_tb_cadastro1'];
					$tbCadastroIdTbCadastro1_print = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(
					DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome"), 
					DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "razao_social"), 
					DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1));
					
				}
				if($GLOBALS['habilitarCadastroVinculo2'] == 1)
				{
					$tbCadastroIdTbCadastro2 = $linhaCadastro['id_tb_cadastro2'];
					$tbCadastroIdTbCadastro2_print = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(
					DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome"), 
					DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "razao_social"), 
					DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 1));
				}
				if($GLOBALS['habilitarCadastroVinculo3'] == 1)
				{
					$tbCadastroIdTbCadastro3 = $linhaCadastro['id_tb_cadastro3'];
					$tbCadastroIdTbCadastro3_print = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(
					DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome"), 
					DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "razao_social"), 
					DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 1));
				}
	
				$tbCadastroAtivacao = $linhaCadastro['ativacao'];
				if($GLOBALS['habilitarCadastroAtivacaoDestaque'] == 1)
				{
					$tbCadastroAtivacaoDestaque = $linhaCadastro['ativacao_destaque'];
				}
				if($GLOBALS['habilitarCadastroUsuario'] == 1)
				{
					$tbCadastroUsuario = $linhaCadastro['usuario'];
				}
				if($GLOBALS['habilitarCadastroSenha'] == 1)
				{
					if($GLOBALS['configCadastroMetodoSenha'] == 2){
						if($GLOBALS['configCadastroSenha'] == 1){
							$tbCadastroSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha'], 2), 2);
						}
					}
				}
				
				if($GLOBALS['habilitarCadastroImagem'] == 1)
				{
					$tbCadastroImagem = $linhaCadastro['imagem'];
				}
				if($GLOBALS['habilitarCadastroLogo'] == 1)
				{
					$tbCadastroLogo = $linhaCadastro['logo'];
				}
				if($GLOBALS['habilitarCadastroBanner'] == 1)
				{
					$tbCadastroBanner = $linhaCadastro['banner'];
				}	
				if($GLOBALS['habilitarCadastroMapa'] == 1){
					$tbCadastroMapa = $linhaCadastro['mapa'];
				}	
				
				if($GLOBALS['habilitarCadastroMapaOnline'] == 1)
				{
					$tbCadastroMapaOnline = $linhaCadastro['mapa_online'];
				}	
				if($GLOBALS['habilitarCadastroPalavrasChave'] == 1)
				{
					$tbCadastroPalavrasChave = $linhaCadastro['palavras_chave'];
				}	
				if($GLOBALS['habilitarCadastroApresentacao'] == 1)
				{
					$tbCadastroApresentacao = Funcoes::ConteudoMascaraLeitura($linhaCadastro['apresentacao']);
				}
				if($GLOBALS['habilitarCadastroServicos'] == 1)
				{	
					$tbCadastroServicos = Funcoes::ConteudoMascaraLeitura($linhaCadastro['servicos']);
				}
				if($GLOBALS['HabilitarCadastroPromocoes'] == 1)
				{
					$tbCadastroPromocoes = Funcoes::ConteudoMascaraLeitura($linhaCadastro['promocoes']);
				}
				if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1)
				{
					$tbCadastroCondicoesComerciais = Funcoes::ConteudoMascaraLeitura($linhaCadastro['condicoes_comerciais']);
				}
				if($GLOBALS['habilitarCadastroFormasPagamento'] == 1)
				{
					$tbCadastroFormasPagamento = Funcoes::ConteudoMascaraLeitura($linhaCadastro['formas_pagamento']);
				}
				if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1)
				{
					$tbCadastroHorarioAtendimento = Funcoes::ConteudoMascaraLeitura($linhaCadastro['horario_atendimento']);
				}
				if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1)
				{
					$tbCadastroSituacaoAtual = Funcoes::ConteudoMascaraLeitura($linhaCadastro['situacao_atual']);
				}
	
				if($GLOBALS['habilitarCadastroIc1'] == 1)
				{
					$tbCadastroIC1 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar1']);
				}
				if($GLOBALS['habilitarCadastroIc2'] == 1)
				{
					$tbCadastroIC2 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar2']);
				}
				if($GLOBALS['habilitarCadastroIc3'] == 1)
				{
					$tbCadastroIC3 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar3']);
				}
				if($GLOBALS['habilitarCadastroIc4'] == 1)
				{
					$tbCadastroIC4 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar4']);
				}
				if($GLOBALS['habilitarCadastroIc5'] == 1)
				{
					$tbCadastroIC5 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar5']);
				}
				if($GLOBALS['habilitarCadastroIc6'] == 1)
				{
					$tbCadastroIC6 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar6']);
				}
				if($GLOBALS['habilitarCadastroIc7'] == 1)
				{
					$tbCadastroIC7 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar7']);
				}
				if($GLOBALS['habilitarCadastroIc8'] == 1)
				{
					$tbCadastroIC8 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar8']);
				}
				if($GLOBALS['habilitarCadastroIc9'] == 1)
				{
					$tbCadastroIC9 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar9']);
				}
				if($GLOBALS['habilitarCadastroIc10'] == 1)
				{
					$tbCadastroIC10 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar10']);
				}
				if($GLOBALS['habilitarCadastroIc11'] == 1)
				{
					$tbCadastroIC11 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar11']);
				}
				if($GLOBALS['habilitarCadastroIc12'] == 1)
				{
					$tbCadastroIC12 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar12']);
				}
				if($GLOBALS['habilitarCadastroIc13'] == 1)
				{
					$tbCadastroIC13 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar13']);
				}
				if($GLOBALS['habilitarCadastroIc14'] == 1)
				{
					$tbCadastroIC14 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar14']);
				}
				if($GLOBALS['habilitarCadastroIc15'] == 1)
				{
					$tbCadastroIC15 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar15']);
				}
				if($GLOBALS['habilitarCadastroIc16'] == 1)
				{
					$tbCadastroIC16 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar16']);
				}
				if($GLOBALS['habilitarCadastroIc17'] == 1)
				{
					$tbCadastroIC17 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar17']);
				}
				if($GLOBALS['habilitarCadastroIc18'] == 1)
				{
					$tbCadastroIC18 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar18']);
				}
				if($GLOBALS['habilitarCadastroIc19'] == 1)
				{
					$tbCadastroIC19 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar19']);
				}
				if($GLOBALS['habilitarCadastroIc20'] == 1)
				{
					$tbCadastroIC20 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar20']);
				}
				if($GLOBALS['habilitarCadastroIc21'] == 1)
				{
					$tbCadastroIC21 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar21']);
				}
				if($GLOBALS['habilitarCadastroIc22'] == 1)
				{
					$tbCadastroIC22 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar22']);
				}
				if($GLOBALS['habilitarCadastroIc23'] == 1)
				{
					$tbCadastroIC23 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar23']);
				}
				if($GLOBALS['habilitarCadastroIc24'] == 1)
				{
					$tbCadastroIC24 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar24']);
				}
				if($GLOBALS['habilitarCadastroIc25'] == 1)
				{
					$tbCadastroIC25 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar25']);
				}
				if($GLOBALS['habilitarCadastroIc26'] == 1)
				{
					$tbCadastroIC26 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar26']);
				}
				if($GLOBALS['habilitarCadastroIc27'] == 1)
				{
					$tbCadastroIC27 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar27']);
				}
				if($GLOBALS['habilitarCadastroIc28'] == 1)
				{
					$tbCadastroIC28 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar28']);
				}
				if($GLOBALS['habilitarCadastroIc29'] == 1)
				{
					$tbCadastroIC29 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar29']);
				}
				if($GLOBALS['habilitarCadastroIc30'] == 1)
				{
					$tbCadastroIC30 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar30']);
				}
				if($GLOBALS['habilitarCadastroIc31'] == 1)
				{
					$tbCadastroIC31 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar31']);
				}
				if($GLOBALS['habilitarCadastroIc32'] == 1)
				{
					$tbCadastroIC32 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar32']);
				}
				if($GLOBALS['habilitarCadastroIc33'] == 1)
				{
					$tbCadastroIC33 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar33']);
				}
				if($GLOBALS['habilitarCadastroIc34'] == 1)
				{
					$tbCadastroIC34 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar34']);
				}
				if($GLOBALS['habilitarCadastroIc35'] == 1)
				{
					$tbCadastroIC35 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar35']);
				}
				if($GLOBALS['habilitarCadastroIc36'] == 1)
				{
					$tbCadastroIC36 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar36']);
				}
				if($GLOBALS['habilitarCadastroIc37'] == 1)
				{
					$tbCadastroIC37 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar37']);
				}
				if($GLOBALS['habilitarCadastroIc38'] == 1)
				{
					$tbCadastroIC38 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar38']);
				}
				if($GLOBALS['habilitarCadastroIc39'] == 1)
				{
					$tbCadastroIC39 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar39']);
				}
				if($GLOBALS['habilitarCadastroIc40'] == 1)
				{
					$tbCadastroIC40 = Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar40']);
				}
				
				$tbCadastroNVisitas = $linhaCadastro['n_visitas'];
				$tbCadastroOrigemCadastro = $linhaCadastro['origem_cadastro'];

				
				//Impressão das informações.
				echo $tbCadastroId . $strSeparador;
				echo $tbCadastroDataCadastro . $strSeparador;
				//echo $tbCadastroIdTbCategorias . $strSeparador;
				
				if($GLOBALS['habilitarCadastroData1'] == 1)
				{
					echo $tbCadastroData1 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroData2'] == 1)
				{
					echo $tbCadastroData2 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroData3'] == 1)
				{
					echo $tbCadastroData3 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroData4'] == 1)
				{
					echo $tbCadastroData4 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroData5'] == 1)
				{
					echo $tbCadastroData5 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroData6'] == 1)
				{
					echo $tbCadastroData6 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroData7'] == 1)
				{
					echo $tbCadastroData7 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroData8'] == 1)
				{
					echo $tbCadastroData8 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroData9'] == 1)
				{
					echo $tbCadastroData9 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroData10'] == 1)
				{
					echo $tbCadastroData10 . $strSeparador;
				}
				
				if($GLOBALS['habilitarCadastroPfPj'] == 1){
					echo $tbCadastroPfPj . $strSeparador;
				}
				
				if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1)
				{
					echo $tbCadastroFiltroGenerico01 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1)
				{
					echo $tbCadastroFiltroGenerico02 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1)
				{
					echo $tbCadastroFiltroGenerico03 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1)
				{
					echo $tbCadastroFiltroGenerico04 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1)
				{
					echo $tbCadastroFiltroGenerico05 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1)
				{
					echo $tbCadastroFiltroGenerico06 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1)
				{
					echo $tbCadastroFiltroGenerico07 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1)
				{
					echo $tbCadastroFiltroGenerico08 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1)
				{
					echo $tbCadastroFiltroGenerico09 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1)
				{
					echo $tbCadastroFiltroGenerico10 . $strSeparador;
				}
				
				echo $tbCadastroNome . $strSeparador;
				if($GLOBALS['habilitarCadastroSexo'] == 1)
				{
					echo $tbCadastroSexo . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroAlturaPeso'] == 1)
				{
					echo $tbCadastroAltura . $strSeparador;
					echo $tbCadastroPeso . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroRazaoSocial'] == 1)
				{
					echo $tbCadastroRazaoSocial . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroNomeFantasia'] == 1)
				{
					echo $tbCadastroNomeFantasia . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroDataNascimento'] == 1)
				{
					echo $tbCadastroDataNascimento . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroCPFRG'] == 1)
				{
					echo $tbCadastroCPF . $strSeparador;
					echo $tbCadastroRG . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroCNPJ'] == 1)
				{
					echo $tbCadastroCNPJ . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroDocumento'] == 1)
				{
					echo $tbCadastroDocumento . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1)
				{
					echo $tbCadastroIMunicipal . $strSeparador;
					echo $tbCadastroIEstadual . $strSeparador;
				}
	
				echo $tbCadastroEnderecoPrincipal . $strSeparador;
				echo $tbCadastroEnderecoNumeroPrincipal . $strSeparador;
				echo $tbCadastroEnderecoComplementoPrincipal . $strSeparador;
				echo $tbCadastroBairroPrincipal . $strSeparador;
				echo $tbCadastroCidadePrincipal . $strSeparador;
				echo $tbCadastroEstadoPrincipal . $strSeparador;
				echo $tbCadastroPaisPrincipal . $strSeparador;
				
				//echo $tbCadastroIdDBCepTblBairros . $strSeparador;
				//echo $tbCadastroIdDBCepTblCidades . $strSeparador;
				//echo $tbCadastroIdDBCepTblLogradouros . $strSeparador;
				//echo $tbCadastroIdDBCepTblUF . $strSeparador;
	
				echo $tbCadastroCepPrincipal . $strSeparador;
				
				if($GLOBALS['habilitarCadastroPontoReferencia'] == 1)
				{
					echo $tbCadastroPontoReferencia . $strSeparador;
				}
				echo $tbCadastroEmailPrincipal . $strSeparador;
				
				//echo $tbCadastroTelDDDPrincipal . $strSeparador;
				//echo $tbCadastroTelPrincipal . $strSeparador;
				echo "(" . $tbCadastroTelDDDPrincipal . ") " . $tbCadastroTelPrincipal . $strSeparador;
				
				//echo $tbCadastroCelDDDPrincipal . $strSeparador;
				//echo $tbCadastroCelPrincipal . $strSeparador;
				echo "(" . $tbCadastroCelDDDPrincipal . ") " . $tbCadastroCelPrincipal . $strSeparador;

				//echo $tbCadastroFaxDDDPrincipal . $strSeparador;
				//echo $tbCadastroFaxPrincipal . $strSeparador;
				echo "(" . $tbCadastroFaxDDDPrincipal . ") " . $tbCadastroFaxPrincipal . $strSeparador;

				if($GLOBALS['habilitarCadastroSite'] == 1)
				{
					echo $tbCadastroSitePrincipal . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroNFuncionarios'] == 1)
				{
					echo $tbCadastroNFuncionarios . $strSeparador;
				}
				$tbCadastroOBSInterno = Funcoes::ConteudoMascaraLeitura($linhaCadastro['obs_interno']);
				if($GLOBALS['habilitarCadastroStatus'] == 1)
				{
					//echo $tbCadastroIdTbCadastroStatus . $strSeparador;
					echo $tbCadastroIdTbCadastroStatus_print . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroAtivacaoMalaDireta'] == 1)
				{
					echo $tbCadastroAtivacaoMalaDireta . $strSeparador;
				}
	
				if($GLOBALS['habilitarCadastroVinculo1'] == 1)
				{
					//echo $tbCadastroIdTbCadastro1 . $strSeparador;
					echo $tbCadastroIdTbCadastro1_print . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroVinculo2'] == 1)
				{
					//echo $tbCadastroIdTbCadastro2 . $strSeparador;
					echo $tbCadastroIdTbCadastro2_print . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroVinculo3'] == 1)
				{
					//echo $tbCadastroIdTbCadastro3 . $strSeparador;
					echo $tbCadastroIdTbCadastro3_print . $strSeparador;
				}
	
				$tbCadastroAtivacao . $strSeparador;
				if($GLOBALS['habilitarCadastroAtivacaoDestaque'] == 1)
				{
					echo $tbCadastroAtivacaoDestaque . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroUsuario'] == 1)
				{
					echo $tbCadastroUsuario . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroSenha'] == 1)
				{
					echo $tbCadastroSenha . $strSeparador;
				}
				
				if($GLOBALS['habilitarCadastroImagem'] == 1)
				{
					echo $tbCadastroImagem . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroLogo'] == 1)
				{
					echo $tbCadastroLogo . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroBanner'] == 1)
				{
					echo $tbCadastroBanner . $strSeparador;
				}	
				if($GLOBALS['habilitarCadastroMapa'] == 1){
					echo $tbCadastroMapa . $strSeparador;
				}	
				
				if($GLOBALS['habilitarCadastroMapaOnline'] == 1)
				{
					echo $tbCadastroMapaOnline . $strSeparador;
				}	
				if($GLOBALS['habilitarCadastroPalavrasChave'] == 1)
				{
					echo $tbCadastroPalavrasChave . $strSeparador;
				}	
				if($GLOBALS['habilitarCadastroApresentacao'] == 1)
				{
					echo $tbCadastroApresentacao . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroServicos'] == 1)
				{	
					echo $tbCadastroServicos . $strSeparador;
				}
				if($GLOBALS['HabilitarCadastroPromocoes'] == 1)
				{
					echo $tbCadastroPromocoes . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroCondicoesComerciais'] == 1)
				{
					echo $tbCadastroCondicoesComerciais . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroFormasPagamento'] == 1)
				{
					echo $tbCadastroFormasPagamento . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroHorarioAtendimento'] == 1)
				{
					echo $tbCadastroHorarioAtendimento . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroSituacaoAtual'] == 1)
				{
					echo $tbCadastroSituacaoAtual . $strSeparador;
				}
	
				if($GLOBALS['habilitarCadastroIc1'] == 1)
				{
					echo $tbCadastroIC1 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc2'] == 1)
				{
					echo $tbCadastroIC2 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc3'] == 1)
				{
					echo $tbCadastroIC3 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc4'] == 1)
				{
					echo $tbCadastroIC4 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc5'] == 1)
				{
					echo $tbCadastroIC5 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc6'] == 1)
				{
					echo $tbCadastroIC6 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc7'] == 1)
				{
					echo $tbCadastroIC7 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc8'] == 1)
				{
					echo $tbCadastroIC8 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc9'] == 1)
				{
					echo $tbCadastroIC9 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc10'] == 1)
				{
					echo $tbCadastroIC10 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc11'] == 1)
				{
					echo $tbCadastroIC11 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc12'] == 1)
				{
					echo $tbCadastroIC12 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc13'] == 1)
				{
					echo $tbCadastroIC13 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc14'] == 1)
				{
					echo $tbCadastroIC14 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc15'] == 1)
				{
					echo $tbCadastroIC15 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc16'] == 1)
				{
					echo $tbCadastroIC16 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc17'] == 1)
				{
					echo $tbCadastroIC17 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc18'] == 1)
				{
					echo $tbCadastroIC18 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc19'] == 1)
				{
					echo $tbCadastroIC19 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc20'] == 1)
				{
					echo $tbCadastroIC20 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc21'] == 1)
				{
					echo $tbCadastroIC21 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc22'] == 1)
				{
					echo $tbCadastroIC22 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc23'] == 1)
				{
					echo $tbCadastroIC23 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc24'] == 1)
				{
					echo $tbCadastroIC24 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc25'] == 1)
				{
					echo $tbCadastroIC25 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc26'] == 1)
				{
					echo $tbCadastroIC26 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc27'] == 1)
				{
					echo $tbCadastroIC27 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc28'] == 1)
				{
					echo $tbCadastroIC28 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc29'] == 1)
				{
					echo $tbCadastroIC29 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc30'] == 1)
				{
					echo $tbCadastroIC30 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc31'] == 1)
				{
					echo $tbCadastroIC31 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc32'] == 1)
				{
					echo $tbCadastroIC32 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc33'] == 1)
				{
					echo $tbCadastroIC33 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc34'] == 1)
				{
					echo $tbCadastroIC34 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc35'] == 1)
				{
					echo $tbCadastroIC35 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc36'] == 1)
				{
					echo $tbCadastroIC36 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc37'] == 1)
				{
					echo $tbCadastroIC37 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc38'] == 1)
				{
					echo $tbCadastroIC38 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc39'] == 1)
				{
					echo $tbCadastroIC39 . $strSeparador;
				}
				if($GLOBALS['habilitarCadastroIc40'] == 1)
				{
					echo $tbCadastroIC40 . $strSeparador;
				}
				
				echo $tbCadastroNVisitas . $strSeparador;
				//echo $tbCadastroOrigemCadastro . $strSeparador;

				
				//Verificação de erro.
				//echo "tbCadastroId=" . $tbCadastroId . "<br>";
                //echo "id=" . $linhaCategorias['id'] . "<br />";
                //echo "id=" . $linhaCadastro['id'] . $strSeparador;
				//$tbCadastroFiltroGenerico01 = Funcoes::IdsFormatar01($tbCadastroFiltroGenerico01);
				echo "<br />";
            ?>
            
            
            <?php } ?> 
            
            <?php 
			//exportação.
			//$page->exportacao_cadastro = ob_get_clean(); 
			$page->exportacao_cadastro = ob_get_contents(); 
			?>
        </div>
    <?php } ?> 
		<?php
        //Verificação de erro.
        //$testeFormatacao = "teste01, teste02, teste03, ";
        //$testeFormatacaoFuncao = Funcoes::IdsFormatar01($testeFormatacao);
        //echo "testeFormatacaoFuncao=" . $testeFormatacaoFuncao . "<br />";
        /*
        function FilterArray($value)
        {
            return ($value == 2);
        }
        */
        //print_r("array_filter=" . array_filter($resultadoCadastro, array("id" => "3530")));
        //print_r("array_filter=" . array_filter($resultadoCadastro, 'filterArray'));
        //print_r("array_filter=" . array_filter($resultadoCadastro, function($value, $key){
        //condition
        //}, ARRAY_FILTER_USE_BOTH));
        /*
            print_r("array_filter=" . array_filter($resultadoCadastro, function ($var) {
            return (strpos('id', '3530') == true);
        }));
        */
        
            //echo "array_intersect_key=" . var_dump(array_intersect_key($resultadoCadastro, array_flip('id', '3530'))) . "<br />";
        //$f = array_filter(array_keys($resultadoCadastro), function ($k){ return strlen("id")=='3530'; }); 
        //$b = array_intersect_key($a, array_flip($f));
        //$allowed = array("3530");
        /*print_r(array_flip(array_filter(array_flip($resultadoCadastro), function ($key) use ($allowed)
        {
            return in_array($key, $allowed);
        })));*/
        //print_r(array_keys($resultadoCadastro, 'id'=>'3530'));
        //print_r("array_search=" . array_search("3530",$resultadoCadastro));
    
    
        
        
        //Limpeza de objetos.
        //----------
        unset($strSqlCadastroSelect);
        unset($statementCadastroSelect);
        unset($resultadoCadastro);
        unset($linhaCadastro);
        //----------
        ?>
        
        
		<?php //Gravação do arquivo no servidor.?>
		<?php //----------?>
		<?php
		//Obs: Talvez colocar esta opção como opcional.
        $arquivoConteudo = $page->exportacao_cadastro;
		$arquivoConteudo = str_replace("<br />", "", $arquivoConteudo);
		//$arquivoConteudo = html_entity_decode($arquivoConteudo);
		//Obs: linux - talvez tenha que mudar "IncludeConfig" para "exportacao".
		$arquivoConteudo = preg_replace("/[ \t]+/", " ", $arquivoConteudo); //Retirar espaços extras (obs: transformar em função).

		$arquivoNome = "exportacao_cadastro";
		$arquivoExtensao = "txt";
        
        
        //$myfile = fopen($GLOBALS['configDiretorioExportacao'] . "/" . "newfile.txt", "w") or die("Unable to open file!");
        ////$myfile = fopen(dirname(__FILE__) . "/" . $GLOBALS['configDiretorioExportacao'] . "/" . "newfile.txt", "w") or die("Unable to open file!");
        
        //$txt = "Mickey Mouse\n";
        //fwrite($myfile, $txt);
        //$txt = "Minnie Mouse\n";
        //fwrite($myfile, $txt);
        //fclose($GLOBALS['configDiretorioExportacao'] . "/" . $myfile);
        ////fclose(dirname(__FILE__) . "/" . $GLOBALS['configDiretorioExportacao'] . "/" . $myfile);
        ?>
        <?php 
        //if(Exportacao::GravarArquivoDados01("teste de gracação", $GLOBALS['configDiretorioExportacao'], "exportacao_cadastro", "txt", 1) == true)
        if(Exportacao::GravarArquivoDados01($arquivoConteudo, $GLOBALS['configCaminhoExportacao'], $arquivoNome, $arquivoExtensao, 1) == true)
        {
        ?>
            <div align="center" class="TextoSucesso">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus24"); ?>
            </div>
            <div align="center" class="Texto01" style="position: relative; display: block; overflow: hidden;">
                <a href="<?php echo $GLOBALS['configCaminhoExportacaoDownload'];?>/<?php echo $arquivoNome . "." . $arquivoExtensao;?>" class="Links03" target="_blank">
                	<?php echo $arquivoNome . "." . $arquivoExtensao;?>
                </a>
            </div>
        <?php }else{ ?> 
            <div align="center" class="TextoErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus24e"); ?>
            </div>
        <?php } ?> 
		<?php //----------?>
    <?php } ?> 
    <?php //**************************************************************************************?>


	<?php //Relatórios - Aulas.?>
    <?php //**************************************************************************************?>
    <?php if($tipoRelatorio == "aulas"){ ?>
    <div class="Texto01" style="position: relative; display: block; overflow: hidden;">
    
    </div>
    <?php } ?> 
    <?php //**************************************************************************************?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>