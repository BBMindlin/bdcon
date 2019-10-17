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



//Definição de variáveis.
if($idTbCadastro <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelEnderecosAdministrar");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
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
    
    
    <?php
	if (empty($resultadoCadastroEnderecos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formCadastroEnderecosAcoes" id="formCadastroEnderecosAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_cadastro_enderecos" />
            <input name="idTbCadastro" id="idTbCadastro" type="hidden" value="<?php echo $idTbCadastro; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTitulo"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarCadastroEnderecosTipo'] == 1){ ?>
                <td width="120" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
			  	$countTabelaFundo = 0;
				
				
                //Loop pelos resultados.
                foreach($resultadoCadastroEnderecos as $linhaCadastroEnderecos)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['endereco_titulo']);?>
                        </strong>
                    </div>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEndereco"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['endereco']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEnderecoNumero"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['endereco_numero']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEnderecoComplemento"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['endereco_complemento']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosBairro"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['bairro']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosCidade"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['cidade']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEstado"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['estado']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosPais"); ?>: 
                        </strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastroEnderecos['pais']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosCEP"); ?>: 
                        </strong>
						<?php echo Funcoes::FormatarCEPLer($linhaCadastroEnderecos['cep']);?>
                    </div>
                    
                    <?php if(empty($idTbCadastro)){ ?>
                    <?php //if($idParent == ""){ ?>
						<?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01($linhaCadastroEnderecos['id_tb_cadastro'], "tb_cadastro", "id") <> ""){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemCadastroVinculado"); ?>: 
                                </strong>
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $idTbCadastro;?>&masterPageSiteSelect=LayoutSistemaSemMenu.php" target="_blank" class="AdmLinks01">
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
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 1){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo1"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 2){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo2"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 3){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo3"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 4){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo4"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 5){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo5"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 6){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo6"); ?>
                        <?php } ?>
						<?php if($linhaCadastroEnderecos['tipo_endereco'] == 7){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo7"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaCadastroEnderecos['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaCadastroEnderecos['id'];?>&statusAtivacao=<?php echo $linhaCadastroEnderecos['ativacao'];?>&strTabela=tb_cadastro_enderecos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaCadastroEnderecos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaCadastroEnderecos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaCategorias['ativacao'];?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmCadastroEnderecosEditar.php?idTbCadastroEnderecos=<?php echo $linhaCadastroEnderecos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastroEnderecos['id'];?>" class="AdmCampoCheckBox01" />
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
    <form name="formCadastroEnderecos" id="formCadastroEnderecos" action="SiteAdmCadastroEnderecosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTbEndereco"); ?>
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
                                    <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo1"); ?></option>
                                    <option value="2"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo2"); ?></option>
                                    <option value="3"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo3"); ?></option>
                                <?php } ?>
                                <option value="4"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo4"); ?></option>
                                <option value="5" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo5"); ?></option>
                                <option value="6"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo6"); ?></option>
                                <option value="7"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosTipo7"); ?></option>
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
                            
                                <input type="text" name="data_endereco" id="data_endereco" class="AdmCampoData01" maxlength="10" value="<?php echo $dataAtual; ?>" />
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
                            <input type="text" name="horario" id="horario" class="AdmCampoTexto02" maxlength="255" />
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
                            <input type="text" name="endereco_titulo" id="endereco_titulo" class="AdmCampoTexto02" maxlength="255" />
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
                                <textarea name="endereco_descricao" id="endereco_descricao" class="AdmCampoTextoMultilinha01"></textarea>
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
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosSite"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <textarea name="endereco_site" id="endereco_site" class="AdmCampoTextoMultilinhaURL"></textarea>
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
                            <input type="text" name="endereco_email" id="endereco_email" class="AdmCampoTexto02" maxlength="255" />
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
                            <input type="text" name="cep" id="cep" class="AdmCampoTexto03" maxlength="255"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formCadastroEnderecos', 'cep');"<?php } ?> />
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
                            <input type="text" name="endereco" id="endereco" class="AdmCampoTexto02" maxlength="255" />
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
                            <input type="text" name="endereco_numero" id="endereco_numero" class="AdmCampoTexto03" maxlength="255" />
                        </div>
                    </td>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosEnderecoComplemento"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="endereco_complemento" id="endereco_complemento" class="AdmCampoTexto03" maxlength="255" />
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
                            <input type="text" name="bairro" id="bairro" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosCidade"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="cidade" id="cidade" class="AdmCampoTexto02" maxlength="255" />
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
                            <input type="text" name="estado" id="estado" class="AdmCampoTexto03" maxlength="255" />
                        </div>
                    </td>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnderecosPais"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaColuna01">
                        <div align="left">
                            <input type="text" name="pais" id="pais" class="AdmCampoTexto02" maxlength="255" />
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
                            <input type="text" name="ponto_referencia" id="ponto_referencia" class="AdmCampoTexto02" maxlength="255" />
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
                            <textarea name="mapa_online" id="mapa_online" class="AdmCampoTextoMultilinha01"></textarea>
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
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                                <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
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
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01">
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
                            <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
                
                <input type="hidden" id="id_db_cep_tblBairros" name="id_db_cep_tblBairros" value="0" />
                <input type="hidden" id="id_db_cep_tblCidades" name="id_db_cep_tblCidades" value="0" />
                <input type="hidden" id="id_db_cep_tblLogradouros" name="id_db_cep_tblLogradouros" value="0" />
                <input type="hidden" id="id_db_cep_tblUF" name="id_db_cep_tblUF" value="0" />

                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
	<?php } ?>
    
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
unset($strSqlCadastroEnderecosSelect);
unset($statementCadastroEnderecosSelect);
unset($resultadoCadastroEnderecos);
unset($linhaCadastroEnderecos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>