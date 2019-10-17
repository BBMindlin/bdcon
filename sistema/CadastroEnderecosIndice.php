<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCadastro = $_GET["idTbCadastro"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$dataAtual = "";
if($GLOBALS['configSistemaFormatoData'] == 1)
{
	$dataAtual = date("d") . "/" . date("m") . "/" . date("Y");
	
}
if($GLOBALS['configSistemaFormatoData'] == 2)
{
	$dataAtual = date("m") . "/" . date("d") . "/" . date("Y");
}

$palavraChave = $_GET["palavraChave"];

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
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlCadastroEnderecosSelect = "";
$strSqlCadastroEnderecosSelect .= "SELECT ";
//$strSqlCadastroEnderecosSelect .= "SELECT * FROM tb_cadastro_enderecos";
//$strSqlCadastroEnderecosSelect .= "* ";
/**/
$strSqlCadastroEnderecosSelect .= "id, ";
$strSqlCadastroEnderecosSelect .= "id_tb_cadastro, ";
$strSqlCadastroEnderecosSelect .= "tipo_endereco, ";
$strSqlCadastroEnderecosSelect .= "data_endereco, ";
$strSqlCadastroEnderecosSelect .= "horario, ";
$strSqlCadastroEnderecosSelect .= "endereco_titulo, ";
$strSqlCadastroEnderecosSelect .= "endereco_descricao, ";
$strSqlCadastroEnderecosSelect .= "endereco_site, ";
$strSqlCadastroEnderecosSelect .= "endereco_email, ";

$strSqlCadastroEnderecosSelect .= "id_db_cep_tblBairros, ";
$strSqlCadastroEnderecosSelect .= "id_db_cep_tblCidades, ";
$strSqlCadastroEnderecosSelect .= "id_db_cep_tblLogradouros, ";
$strSqlCadastroEnderecosSelect .= "id_db_cep_tblUF, ";

$strSqlCadastroEnderecosSelect .= "cep, ";
$strSqlCadastroEnderecosSelect .= "endereco, ";
$strSqlCadastroEnderecosSelect .= "endereco_numero, ";
$strSqlCadastroEnderecosSelect .= "endereco_complemento, ";
$strSqlCadastroEnderecosSelect .= "bairro, ";
$strSqlCadastroEnderecosSelect .= "cidade, ";
$strSqlCadastroEnderecosSelect .= "estado, ";
$strSqlCadastroEnderecosSelect .= "pais, ";

$strSqlCadastroEnderecosSelect .= "ponto_referencia, ";
$strSqlCadastroEnderecosSelect .= "mapa_online, ";
$strSqlCadastroEnderecosSelect .= "ativacao, ";
$strSqlCadastroEnderecosSelect .= "imagem, ";
$strSqlCadastroEnderecosSelect .= "obs ";
$strSqlCadastroEnderecosSelect .= "FROM tb_cadastro_enderecos ";
$strSqlCadastroEnderecosSelect .= "WHERE id <> 0 ";

if($idTbCadastro <> "")
{
	$strSqlCadastroEnderecosSelect .= "AND id_tb_cadastro = :id_tb_cadastro ";
}
if($palavraChave <> "")
{
	$strSqlCadastroEnderecosSelect .= "AND (endereco_titulo LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR endereco_descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR endereco_site LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR endereco_email LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR cep LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR endereco LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR endereco_numero LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR endereco_complemento LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR bairro LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR cidade LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR estado LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR pais LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR ponto_referencia LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= "OR obs LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlCadastroEnderecosSelect .= ") ";
}

$strSqlCadastroEnderecosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroEnderecos'] . " ";

//----------


//Parâmetros.
//----------
$statementCadastroEnderecosSelect = $dbSistemaConPDO->prepare($strSqlCadastroEnderecosSelect);

if ($statementCadastroEnderecosSelect !== false)
{
	/*
	$statementCadastroEnderecosSelect->execute(array(
		"id_tb_cadastro" => $idTbCadastro
	));
	*/
	if($idTbCadastro <> "")
	{
		$statementCadastroEnderecosSelect->bindParam(':id_tb_cadastro', $idTbCadastro, PDO::PARAM_STR);
	}
	$statementCadastroEnderecosSelect->execute();
	
}

//$resultadoCadastroEnderecos = $dbSistemaConPDO->query($strSqlCadastroEnderecosSelect);
$resultadoCadastroEnderecos = $statementCadastroEnderecosSelect->fetchAll();
//----------
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?>
     - 
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
     - 
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTitulo"); ?>
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
        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTitulo"); ?>
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
    
    <?php
	if (empty($resultadoCadastroEnderecos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formCadastroEnderecosAcoes" id="formCadastroEnderecosAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_enderecos" />
            <input name="idTbCadastro" id="idTbCadastro" type="hidden" value="<?php echo $idTbCadastro; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTitulo"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarCadastroEnderecosTipo'] == 1){ ?>
                <td width="120" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoCadastroEnderecos as $linhaCadastroEnderecos)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
                    	<strong>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['endereco_titulo']);?>
                        </strong>
                    </div>
                    <div class="Texto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEndereco"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['endereco']);?>
                    </div>
                    <div class="Texto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEnderecoNumero"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['endereco_numero']);?>
                    </div>
                    <div class="Texto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEnderecoComplemento"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['endereco_complemento']);?>
                    </div>
                    <div class="Texto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosBairro"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['bairro']);?>
                    </div>
                    <div class="Texto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosCidade"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['cidade']);?>
                    </div>
                    <div class="Texto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEstado"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['estado']);?>
                    </div>
                    <div class="Texto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosPais"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['pais']);?>
                    </div>
                    <div class="Texto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosCEP"); ?>: 
                        </strong>
						<?php echo Funcoes::FormatarCEPLer($linhaCadastroEnderecos['cep']);?>
                    </div>
                    
                    <?php if(empty($idTbCadastro)){ ?>
                    <?php //if($idParent == ""){ ?>
						<?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01($linhaCadastroEnderecos['id_tb_cadastro'], "tb_cadastro", "id") <> ""){ ?>
                            <div class="Texto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemCadastroVinculado"); ?>: 
                                </strong>
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $idTbCadastro;?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaCadastroEnderecos['id_tb_cadastro'], "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01($linhaCadastroEnderecos['id_tb_cadastro'], "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01($linhaCadastroEnderecos['id_tb_cadastro'], "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            </div>
						<?php } ?>
                     <?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarCadastroEnderecosTipo'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 1){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo1"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 2){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo2"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 3){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo3"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 4){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo4"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 5){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo5"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 6){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo6"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 7){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo7"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaCadastroEnderecos['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastroEnderecos['id'];?>&statusAtivacao=<?php echo $linhaCadastroEnderecos['ativacao'];?>&strTabela=tb_cadastro_enderecos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaCadastroEnderecos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastroEnderecos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="CadastroEnderecosEditar.php?idTbCadastroEnderecos=<?php echo $linhaCadastroEnderecos['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroEnderecos['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>

              <?php } ?>
            </table>
        </form>
	<?php } ?>
    
    
    <?php if(!empty($idTbCadastro)){ ?>
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
        //Obs: modifiquei o posicionamento da definição de variávei para fora da condição de exibição do formulário.
    </script>
    <form name="formCadastroEnderecos" id="formCadastroEnderecos" action="CadastroEnderecosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTbEndereco"); ?>
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
                                    <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo1"); ?></option>
                                    <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo2"); ?></option>
                                    <option value="3"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo3"); ?></option>
                                <?php } ?>
                                <option value="4"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo4"); ?></option>
                                <option value="5" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo5"); ?></option>
                                <option value="6"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo6"); ?></option>
                                <option value="7"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosTipo7"); ?></option>
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
                            
                                <input type="text" name="data_endereco" id="data_endereco" class="CampoData01" maxlength="10" value="<?php echo $dataAtual; ?>" />
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
                            <input type="text" name="horario" id="horario" class="CampoTexto01" maxlength="255" />
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
                            <input type="text" name="endereco_titulo" id="endereco_titulo" class="CampoTexto01" maxlength="255" />
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
                                <textarea name="endereco_descricao" id="endereco_descricao" class="CampoTextoMultilinha01"></textarea>
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
                                <textarea name="endereco_descricao" id="endereco_descricao"></textarea>
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
                                <textarea name="endereco_descricao" id="endereco_descricao"></textarea>
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
                            <textarea name="endereco_site" id="endereco_site" class="CampoTextoMultilinhaURL"></textarea>
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
                            <input type="text" name="endereco_email" id="endereco_email" class="CampoTexto01" maxlength="255" />
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
                            <input type="text" name="cep" id="cep" class="CampoTexto02" maxlength="255"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formCadastroEnderecos', 'cep');"<?php } ?> />
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
                            <input type="text" name="endereco" id="endereco" class="CampoTexto01" maxlength="255" />
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
                            <input type="text" name="endereco_numero" id="endereco_numero" class="CampoTexto02" maxlength="255" />
                        </div>
                    </td>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosEnderecoComplemento"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="endereco_complemento" id="endereco_complemento" class="CampoTexto02" maxlength="255" />
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
                            <input type="text" name="bairro" id="bairro" class="CampoTexto01" maxlength="255" />
                        </div>
                    </td>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosCidade"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="cidade" id="cidade" class="CampoTexto01" maxlength="255" />
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
                            <input type="text" name="estado" id="estado" class="CampoTexto02" maxlength="255" />
                        </div>
                    </td>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaEnderecosPais"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="pais" id="pais" class="CampoTexto01" maxlength="255" />
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
                            <input type="text" name="ponto_referencia" id="ponto_referencia" class="CampoTexto01" maxlength="255" />
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
                            <textarea name="mapa_online" id="mapa_online" class="CampoTextoMultilinha01"></textarea>
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
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                                <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
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
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01">
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
                            <textarea name="obs" id="obs" class="CampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
                
                <input type="hidden" id="id_db_cep_tblBairros" name="id_db_cep_tblBairros" value="0" />
                <input type="hidden" id="id_db_cep_tblCidades" name="id_db_cep_tblCidades" value="0" />
                <input type="hidden" id="id_db_cep_tblLogradouros" name="id_db_cep_tblLogradouros" value="0" />
                <input type="hidden" id="id_db_cep_tblUF" name="id_db_cep_tblUF" value="0" />

                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
	<?php } ?>
    
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
unset($strSqlCadastroEnderecosSelect);
unset($statementCadastroEnderecosSelect);
unset($resultadoCadastroEnderecos);
unset($linhaCadastroEnderecos);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>