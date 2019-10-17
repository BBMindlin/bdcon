<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroEnderecos = $_GET["idTbCadastroEnderecos"];
$idTbCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastroEnderecos, "tb_cadastro_enderecos", "id_tb_cadastro");

$paginaRetorno = "CadastroEnderecosIndice.php";
$paginaRetornoExclusao = "CadastroEnderecosEditar.php";
$variavelRetorno = "idTbCadastro";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastro=" . $idTbCadastro . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSelect=" . $masterPageSelect . 
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
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?>
     - 
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
     - 
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEditarTitulo"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
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
        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEditarTitulo"); ?>
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
        //Obs: modifiquei o posicionamento da definição de variávei para fora da condição de exibição do formulário.
    </script>
    <form name="formCadastroEnderecosEditar" id="formCadastroEnderecosEditar" action="CadastroEnderecosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTbEnderecoEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosTipo'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <select name="tipo_endereco" id="tipo_endereco" class="CampoDropDownMenu01">
                            	<?php if($GLOBALS['configCadastroEnderecosTipo'] == 1){ ?>
                                    <option value="1"<?php if($tbCadastroEnderecosTipoEndereco == 1){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo1"); ?></option>
                                    <option value="2"<?php if($tbCadastroEnderecosTipoEndereco == 2){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo2"); ?></option>
                                    <option value="3"<?php if($tbCadastroEnderecosTipoEndereco == 3){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo3"); ?></option>
                                <?php } ?>
                                <option value="4"<?php if($tbCadastroEnderecosTipoEndereco == 4){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo4"); ?></option>
                                <option value="5"<?php if($tbCadastroEnderecosTipoEndereco == 5){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo5"); ?></option>
                                <option value="6"<?php if($tbCadastroEnderecosTipoEndereco == 6){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo6"); ?></option>
                                <option value="7"<?php if($tbCadastroEnderecosTipoEndereco == 7){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo7"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosData'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosData"); ?>:
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
                            
                                <input type="text" name="data_endereco" id="data_endereco" class="CampoData01" maxlength="10" value="<?php echo $tbCadastroEnderecosDataEndereco_print; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosHorario'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosHorario"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="horario" id="horario" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosHorario; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosTitulo'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEnderecoTitulo"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="endereco_titulo" id="endereco_titulo" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosEnderecoTitulo; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosDescricao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosDescricao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
							<?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="endereco_descricao" id="endereco_descricao" class="CampoTextoMultilinha01"><?php echo $tbCadastroEnderecosEnderecoDescricao; ?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosSite"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <textarea name="endereco_site" id="endereco_site" class="CampoTextoMultilinhaURL"><?php echo $tbCadastroEnderecosEnderecoSite; ?></textarea>
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosEmail'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEmail"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="endereco_email" id="endereco_email" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosEnderecoEmail; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosCEP"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="cep" id="cep" class="CampoTexto02" maxlength="255"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formCadastroEnderecos', 'cep');"<?php } ?> value="<?php echo $tbCadastroEnderecosCEP_print; ?>"  />
                            <span id="lblCEPAlerta" class="TextoAlerta" style="display: none;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCEPNaoEncontrado"); ?>
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
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEndereco"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="endereco" id="endereco" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosEndereco; ?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEnderecoNumero"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="endereco_numero" id="endereco_numero" class="CampoTexto02" maxlength="255" value="<?php echo $tbCadastroEnderecosEnderecoNumero; ?>" />
                        </div>
                    </td>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEnderecoComplemento"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="endereco_complemento" id="endereco_complemento" class="CampoTexto02" maxlength="255" value="<?php echo $tbCadastroEnderecosEnderecoComplemento; ?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosBairro"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="bairro" id="bairro" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosBairro; ?>" />
                        </div>
                    </td>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosCidade"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="cidade" id="cidade" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosCidade; ?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEstado"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                            <input type="text" name="estado" id="estado" class="CampoTexto02" maxlength="255" value="<?php echo $tbCadastroEnderecosEstado; ?>" />
                        </div>
                    </td>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosPais"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="pais" id="pais" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosPais; ?>" />
                        </div>
                    </td>
                </tr>

                
				<?php if($GLOBALS['habilitarCadastroEnderecosPontoReferencia'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosPontoReferencia"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="ponto_referencia" id="ponto_referencia" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroEnderecosPontoReferencia; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosMapaOnline'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosMapaOnline"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <textarea name="mapa_online" id="mapa_online" class="CampoTextoMultilinha01"><?php echo $tbCadastroEnderecosMapaOnline; ?></textarea>
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
                            <option value="0"<?php if($tbCadastroEnderecosAtivacao == 0){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbCadastroEnderecosAtivacao == 1){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarCadastroEnderecosImagem'] == 1){ ?>
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
                                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                                    </td>

                                    <?php if(!empty($tbCadastroEnderecosImagem)){ //if($tbCategoriasImagem <> ""){?>
                                    <td width="1">
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbCadastroEnderecosImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbCadastroEnderecosImagem; ?>" style="margin-left: 4px;" />
                                    </td>
                                    <td>
                                        <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbCadastroEnderecosId;?>&strTabela=tb_cadastro_enderecos&strCampo=imagem<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
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
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosOBS"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="CampoTextoMultilinha01"><?php echo $tbCadastroEnderecosOBS; ?></textarea>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbCadastroEnderecos" type="hidden" id="idTbCadastroEnderecos" value="<?php echo $idTbCadastroEnderecos; ?>" />
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbCadastroEnderecosIdTbCadastro; ?>" />
                
                <input type="hidden" id="id_db_cep_tblBairros" name="id_db_cep_tblBairros" value="<?php echo $tbCadastroEnderecosIdDBCepTblBairros;?>" />
                <input type="hidden" id="id_db_cep_tblCidades" name="id_db_cep_tblCidades" value="<?php echo $tbCadastroEnderecosIdDBCepTblCidades;?>" />
                <input type="hidden" id="id_db_cep_tblLogradouros" name="id_db_cep_tblLogradouros" value="<?php echo $tbCadastroEnderecosIdDBCepTblLogradouros;?>" />
                <input type="hidden" id="id_db_cep_tblUF" name="id_db_cep_tblUF" value="<?php echo $tbCadastroEnderecosIdDBCepTblUF;?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?<?php echo $queryPadrao; ?>">
                <!--idTbCadastro=<?php //echo $idTbCadastro; ?>-->
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
    <br />
    
    <div id="updtProgressGenerico" style="display: none;">
        <div class="ProgressBarGenerico01Container">
            <div class="ProgressBarGenerico01">
                <img src="img/ProgressBar01.gif" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaImagemProgressBarra"); ?>" />
            </div>
        </div>
    </div>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
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
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>