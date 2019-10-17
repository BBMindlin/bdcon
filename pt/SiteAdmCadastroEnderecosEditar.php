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
$idTbCadastroEnderecos = $_GET["idTbCadastroEnderecos"];
$idTbCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastroEnderecos, "tb_cadastro_enderecos", "id_tb_cadastro");

$paginaRetorno = "SiteAdmCadastroEnderecosIndice.php";
$paginaRetornoExclusao = "SiteAdmCadastroEnderecosEditar.php";
$variavelRetorno = "idTbCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastro=" . $idTbCadastro . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlCadastroEnderecosDetalhesSelect = "";
$strSqlCadastroEnderecosDetalhesSelect .= "SELECT ";
//$strSqlCadastroEnderecosDetalhesSelect .= "* ";
$strSqlCadastroEnderecosDetalhesSelect .= "id, ";
$strSqlCadastroEnderecosDetalhesSelect .= "id_tb_cadastro, ";
$strSqlCadastroEnderecosDetalhesSelect .= "tipo_endereco, ";
$strSqlCadastroEnderecosDetalhesSelect .= "data_endereco, ";
$strSqlCadastroEnderecosDetalhesSelect .= "horario, ";
$strSqlCadastroEnderecosDetalhesSelect .= "endereco_titulo, ";
$strSqlCadastroEnderecosDetalhesSelect .= "endereco_descricao, ";
$strSqlCadastroEnderecosDetalhesSelect .= "endereco_site, ";
$strSqlCadastroEnderecosDetalhesSelect .= "endereco_email, ";

$strSqlCadastroEnderecosDetalhesSelect .= "id_db_cep_tblBairros, ";
$strSqlCadastroEnderecosDetalhesSelect .= "id_db_cep_tblCidades, ";
$strSqlCadastroEnderecosDetalhesSelect .= "id_db_cep_tblLogradouros, ";
$strSqlCadastroEnderecosDetalhesSelect .= "id_db_cep_tblUF, ";

$strSqlCadastroEnderecosDetalhesSelect .= "cep, ";
$strSqlCadastroEnderecosDetalhesSelect .= "endereco, ";
$strSqlCadastroEnderecosDetalhesSelect .= "endereco_numero, ";
$strSqlCadastroEnderecosDetalhesSelect .= "endereco_complemento, ";
$strSqlCadastroEnderecosDetalhesSelect .= "bairro, ";
$strSqlCadastroEnderecosDetalhesSelect .= "cidade, ";
$strSqlCadastroEnderecosDetalhesSelect .= "estado, ";
$strSqlCadastroEnderecosDetalhesSelect .= "pais, ";

$strSqlCadastroEnderecosDetalhesSelect .= "ponto_referencia, ";
$strSqlCadastroEnderecosDetalhesSelect .= "mapa_online, ";
$strSqlCadastroEnderecosDetalhesSelect .= "ativacao, ";
$strSqlCadastroEnderecosDetalhesSelect .= "imagem, ";
$strSqlCadastroEnderecosDetalhesSelect .= "obs ";
$strSqlCadastroEnderecosDetalhesSelect .= "FROM tb_cadastro_enderecos ";
$strSqlCadastroEnderecosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlCadastroEnderecosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlCadastroEnderecosDetalhesSelect .= "AND id = :id ";
//$strSqlCadastroEnderecosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroEnderecos'] . " ";
//----------


//Parâmetros.
//----------
$statementCadastroEnderecosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCadastroEnderecosDetalhesSelect);

if ($statementCadastroEnderecosDetalhesSelect !== false)
{
	$statementCadastroEnderecosDetalhesSelect->execute(array(
		"id" => $idTbCadastroEnderecos
	));
}

//$resultadoCadastroEnderecosDetalhes = $dbSistemaConPDO->query($strSqlCadastroEnderecosDetalhesSelect);
$resultadoCadastroEnderecosDetalhes = $statementCadastroEnderecosDetalhesSelect->fetchAll();
//----------


if (empty($resultadoCadastroEnderecosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoCadastroEnderecosDetalhes as $linhaCadastroEnderecosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbCadastroEnderecosId = $linhaCadastroEnderecosDetalhes['id'];
		$tbCadastroEnderecosIdTbCadastro = $linhaCadastroEnderecosDetalhes['id_tb_cadastro'];
		$tbCadastroEnderecosTipoEndereco = $linhaCadastroEnderecosDetalhes['tipo_endereco'];
		
		$tbCadastroEnderecosDataEndereco = $linhaCadastroEnderecosDetalhes['data_endereco'];
		$tbCadastroEnderecosDataEndereco_print = Funcoes::DataLeitura01($tbCadastroEnderecosDataEndereco, $GLOBALS['configSistemaFormatoData'], "1");

		$tbCadastroEnderecosHorario = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['horario']);
		$tbCadastroEnderecosEnderecoTitulo = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['endereco_titulo']);
		$tbCadastroEnderecosEnderecoDescricao = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['endereco_descricao']);
		$tbCadastroEnderecosEnderecoSite = $linhaCadastroEnderecosDetalhes['endereco_site'];
		$tbCadastroEnderecosEnderecoEmail = $linhaCadastroEnderecosDetalhes['endereco_email'];
		
		$tbCadastroEnderecosIdDBCepTblBairros = $linhaCadastroEnderecosDetalhes['id_db_cep_tblBairros'];
		$tbCadastroEnderecosIdDBCepTblCidades = $linhaCadastroEnderecosDetalhes['id_db_cep_tblCidades'];
		$tbCadastroEnderecosIdDBCepTblLogradouros = $linhaCadastroEnderecosDetalhes['id_db_cep_tblLogradouros'];
		$tbCadastroEnderecosIdDBCepTblUF = $linhaCadastroEnderecosDetalhes['id_db_cep_tblLogradouros'];

		$tbCadastroEnderecosCEP = $linhaCadastroEnderecosDetalhes['cep'];
		$tbCadastroEnderecosCEP_print = Funcoes::FormatarCEPLer($tbCadastroEnderecosCEP);
		$tbCadastroEnderecosEndereco = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['endereco']);
		$tbCadastroEnderecosEnderecoNumero = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['endereco_numero']);
		$tbCadastroEnderecosEnderecoComplemento = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['endereco_complemento']);
		$tbCadastroEnderecosBairro = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['bairro']);
		$tbCadastroEnderecosCidade = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['cidade']);
		$tbCadastroEnderecosEstado = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['estado']);
		$tbCadastroEnderecosPais = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['pais']);
		
		$tbCadastroEnderecosPontoReferencia = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['ponto_referencia']);
		$tbCadastroEnderecosMapaOnline = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['mapa_online']);
		$tbCadastroEnderecosAtivacao = $linhaCadastroEnderecosDetalhes['ativacao'];
		$tbCadastroEnderecosImagem = $linhaCadastroEnderecosDetalhes['imagem'];
		$tbCadastroEnderecosOBS = Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecosDetalhes['obs']);
		
		
		//Verificação de erro.
		//echo "tbCadastroEnderecosId=" . $tbCadastroEnderecosId . "<br>";
		//echo "tbCadastroEnderecosNome=" . $tbCadastroEnderecosNome . "<br>";
		//echo "tbCadastroEnderecosNome=" . $tbCadastroEnderecosNome . "<br>";
	}
}


//Definição de variáveis.
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEditarTitulo");
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
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


	<?php //Opções gerais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
    <br />
	<?php //Opções principais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "2";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>

    
    <br />
	<?php //Opções de informações complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "ic1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>


	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
        //Obs: modifiquei o posicionamento da definição de variávei para fora da condição de exibição do formulário.
    </script>
    <form name="formCadastroEnderecosEditar" id="formCadastroEnderecosEditar" action="SiteAdmCadastroEnderecosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTbEnderecoEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosTipo'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <select name="tipo_endereco" id="tipo_endereco" class="AdmCampoDropDownMenu01">
                            	<?php if($GLOBALS['configCadastroEnderecosTipo'] == 1){ ?>
                                    <option value="1"<?php if($tbCadastroEnderecosTipoEndereco == 1){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo1"); ?></option>
                                    <option value="2"<?php if($tbCadastroEnderecosTipoEndereco == 2){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo2"); ?></option>
                                    <option value="3"<?php if($tbCadastroEnderecosTipoEndereco == 3){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo3"); ?></option>
                                <?php } ?>
                                <option value="4"<?php if($tbCadastroEnderecosTipoEndereco == 4){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo4"); ?></option>
                                <option value="5"<?php if($tbCadastroEnderecosTipoEndereco == 5){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo5"); ?></option>
                                <option value="6"<?php if($tbCadastroEnderecosTipoEndereco == 6){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo6"); ?></option>
                                <option value="7"<?php if($tbCadastroEnderecosTipoEndereco == 7){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo7"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosData'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosData"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data_tarefa";
										strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_endereco;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data_tarefa";
										strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_endereco;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data_endereco" id="data_endereco" class="AdmCampoData01" maxlength="10" value="<?php echo $tbCadastroEnderecosDataEndereco_print; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosHorario'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosHorario"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="horario" id="horario" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosHorario; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosTitulo'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEnderecoTitulo"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="endereco_titulo" id="endereco_titulo" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosEnderecoTitulo; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosDescricao'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosDescricao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
							<?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="endereco_descricao" id="endereco_descricao" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroEnderecosEnderecoDescricao; ?></textarea>
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
                                <textarea name="endereco_descricao" id="endereco_descricao"><?php echo $tbCadastroEnderecosEnderecoDescricao; ?></textarea>
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
                                <textarea name="endereco_descricao" id="endereco_descricao"><?php echo $tbCadastroEnderecosEnderecoDescricao; ?></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosSite'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosSite"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <textarea name="endereco_site" id="endereco_site" class="AdmCampoTextoMultilinhaURL"><?php echo $tbCadastroEnderecosEnderecoSite; ?></textarea>
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosEmail'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEmail"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="endereco_email" id="endereco_email" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosEnderecoEmail; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosCEP"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="cep" id="cep" class="AdmCampoTexto03" maxlength="255"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formCadastroEnderecos', 'cep');"<?php } ?> value="<?php echo $tbCadastroEnderecosCEP_print; ?>"  />
                            <span id="lblCEPAlerta" class="TextoAlerta" style="display: none;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCEPNaoEncontrado"); ?>
                            </span>
                            
                            <?php //alertas ?>
                            <?php //echo "FormatarCEPLer=" . Funcoes::FormatarCEPLer("22631455") . "<br />";  ?>
                            
                            
                            <?php //JQuery - Ajax - CEP.?>
                            <?php //----------------------?>
                            <?php if($GLOBALS['configCadastroCEPPreenchimento'] == 1){ ?>
                            <script type="text/javascript">
                                $("#cep").keyup(function() {
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
                                                    $("#endereco").val(retornoLogradouro);
                                                    $("#bairro").val(retornoBairro);
                                                    $("#cidade").val(retornoCidade);
                                                    //$("#testeAlvo04").val(retornoEstado);
                                                    $("#estado").val(retornoEstadoCodigo);
                                                    $("#pais").val(retornoPais);
                                                    
                                                    $("#id_db_cep_tblBairros").val(retornoBairroCodigo);
                                                    $("#id_db_cep_tblCidades").val(retornoCidadeCodigo);
                                                    $("#id_db_cep_tblLogradouros").val(retornoLogradouroCodigo);
                                                    $("#id_db_cep_tblUF").val(retornoEstadoCodigo);
                                                    
                                                }else{
                                                    divShow('lblCEPAlerta');
                                                    
                                                    $("#endereco").val("");
                                                    $("#bairro").val("");
                                                    $("#cidade").val("");
                                                    //$("#testeAlvo04").val(retornoEstado);
                                                    $("#estado").val("");
                                                    $("#pais").val("");
                                                    
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
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEndereco"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="endereco" id="endereco" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosEndereco; ?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEnderecoNumero"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro">
                        <div align="left">
                            <input type="text" name="endereco_numero" id="endereco_numero" class="AdmCampoTexto03" maxlength="255" value="<?php echo $tbCadastroEnderecosEnderecoNumero; ?>" />
                        </div>
                    </td>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEnderecoComplemento"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="endereco_complemento" id="endereco_complemento" class="AdmCampoTexto03" maxlength="255" value="<?php echo $tbCadastroEnderecosEnderecoComplemento; ?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosBairro"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro">
                        <div align="left">
                            <input type="text" name="bairro" id="bairro" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosBairro; ?>" />
                        </div>
                    </td>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosCidade"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="cidade" id="cidade" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosCidade; ?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEstado"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro">
                        <div align="left">
                            <input type="text" name="estado" id="estado" class="AdmCampoTexto03" maxlength="255" value="<?php echo $tbCadastroEnderecosEstado; ?>" />
                        </div>
                    </td>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosPais"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="pais" id="pais" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosPais; ?>" />
                        </div>
                    </td>
                </tr>

                
				<?php if($GLOBALS['habilitarCadastroEnderecosPontoReferencia'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosPontoReferencia"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="ponto_referencia" id="ponto_referencia" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosPontoReferencia; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosMapaOnline'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosMapaOnline"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <textarea name="mapa_online" id="mapa_online" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroEnderecosMapaOnline; ?></textarea>
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
                            <option value="0"<?php if($tbCadastroEnderecosAtivacao == 0){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbCadastroEnderecosAtivacao == 1){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosImagem'] == 1){ ?>
                <tr>

                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                <tr>
                                    <td width="1">
                                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01" />
                                    </td>

                                    <?php if(!empty($tbCadastroEnderecosImagem)){ //if($tbCategoriasImagem <> ""){?>
                                    <td width="1">
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCadastroEnderecosImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroEnderecosImagem; ?>" style="margin-left: 4px;" />
                                    </td>
                                    <td>
                                        <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroEnderecosId;?>&strTabela=tb_cadastro_enderecos&strCampo=imagem<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagemExcluir"); ?>
                                        </a>
                                    </td>
                                    <?php } ?>
                                                                
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosOBS"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroEnderecosOBS; ?></textarea>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbCadastroEnderecos" type="hidden" id="idTbCadastroEnderecos" value="<?php echo $idTbCadastroEnderecos; ?>" />
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbCadastroEnderecosIdTbCadastro; ?>" />
                
                <input type="hidden" id="id_db_cep_tblBairros" name="id_db_cep_tblBairros" value="<?php echo $tbCadastroEnderecosIdDBCepTblBairros;?>" />
                <input type="hidden" id="id_db_cep_tblCidades" name="id_db_cep_tblCidades" value="<?php echo $tbCadastroEnderecosIdDBCepTblCidades;?>" />
                <input type="hidden" id="id_db_cep_tblLogradouros" name="id_db_cep_tblLogradouros" value="<?php echo $tbCadastroEnderecosIdDBCepTblLogradouros;?>" />
                <input type="hidden" id="id_db_cep_tblUF" name="id_db_cep_tblUF" value="<?php echo $tbCadastroEnderecosIdDBCepTblUF;?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?<?php echo $queryPadrao; ?>">
                <!--idTbCadastro=<?php //echo $idTbCadastro; ?>-->
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
    <br />
    
    <div id="updtProgressGenerico" class="ProgressBarGenerico01Container" style="display: none;">
        <div class="ProgressBarGenerico01">
            <img src="img/ProgressBar01.gif" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImagemProgressBarra"); ?>" />
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
unset($strSqlCadastroEnderecosDetalhesSelect);
unset($statementCadastroEnderecosDetalhesSelect);
unset($resultadoCadastroEnderecosDetalhes);
unset($linhaCadastroEnderecosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>