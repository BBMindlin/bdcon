<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParentConteudo = $_GET["idParentConteudo"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$idTbCadastro = $_GET["idTbCadastro"];
if($idTbCadastro == "")
{
	$idTbCadastro = 0;
}

$paginaRetorno = "ConteudoIndice.php";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentCategorias=" . $idParentCategorias . "&idTbCadastro=" . $idTbCadastro . "&paginaRetorno=" . $paginaRetorno . "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.



//Query de pesquisa.
//----------
$strSqlConteudoSelect = "";
$strSqlConteudoSelect .= "SELECT ";
$strSqlConteudoSelect .= "id, ";
$strSqlConteudoSelect .= "n_classificacao, ";
$strSqlConteudoSelect .= "id_tb_categorias, ";
$strSqlConteudoSelect .= "id_tb_cadastro, ";
$strSqlConteudoSelect .= "tipo_conteudo, ";
$strSqlConteudoSelect .= "alinhamento_texto, ";
$strSqlConteudoSelect .= "alinhamento_imagem, ";
$strSqlConteudoSelect .= "conteudo, ";
$strSqlConteudoSelect .= "conteudo_link, ";
$strSqlConteudoSelect .= "arquivo, ";
$strSqlConteudoSelect .= "config_arquivo, ";
$strSqlConteudoSelect .= "dimensao_arquivo ";
$strSqlConteudoSelect .= "FROM tb_conteudo ";
$strSqlConteudoSelect .= "WHERE id <> 0 ";
$strSqlConteudoSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlConteudoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoConteudo'] . " ";
//----------


//Parâmetros.
//----------
$statementConteudoSelect = $dbSistemaConPDO->prepare($strSqlConteudoSelect);

if ($statementConteudoSelect !== false)
{
	$statementConteudoSelect->execute(array(
		"id_tb_categorias" => $idParentConteudo
	));
}

//$resultadoConteudo = $dbSistemaConPDO->query($strSqlConteudoSelect);
$resultadoConteudo = $statementConteudoSelect->fetchAll();
//----------
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTitulo"); ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php //echo DbFuncoes::CategoriasCaminho($idParentConteudo, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
        <?php //dando problema no caminho - verificar função - talvez loop infinito por causa o empty; ?>
        <?php //echo "idParentConteudo=" . $idParentConteudo . "<br />"; ?>
        <?php //echo "idParentCategoriasRaiz=" . $idParentCategoriasRaiz . "<br />"; ?>
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
    //if(mysqli_num_rows($resultadoConteudo) == 0){ //Verificação se está vazio.
	//if ($resultadoConteudo->fetchColumn() == 0) //Verificação se está vazio.
	if (empty($resultadoConteudo))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <form name="formConteudoAcoes" id="formConteudoAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_conteudo" />
            <input name="idParentConteudo" id="idParentConteudo" type="hidden" value="<?php echo $idParentConteudo; ?>" />
            <input name="idTbCadastro" type="hidden" id="idTbCadastro" value="<?php echo $idTbCadastro; ?>" />
            
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
            	<?php //Instruções de definição de variáveis. ?>
            	<?php if(DbFuncoes::GetCampoGenerico01($idParentConteudo, "tb_categorias", "id_parent") == $GLOBALS['configIdCategoriasConteudoModelo']){ ?>
                    <div align="left" style="float: left;">
                    	[
                    	<a onclick="divShowHide('divConteudoModeloInstrucoes')" style="cursor: pointer;" class="Links03">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroConteudoModelosInstrucoes"); ?>
                        </a>
                        ]
                    </div>
                <?php } ?>

                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <div class="Texto01" id="divConteudoModeloInstrucoes" style="position:relative; display: none; clear: both;">
            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNome"); ?> = (|(nome)|) <br />
                <?php if($GLOBALS['habilitarCadastroRazaoSocial'] == 1){ ?>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRazaoSocial"); ?> = (|(razao_social)|) <br />
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroNomeFantasia'] == 1){ ?>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNomeFantasia"); ?> = (|(nome_fantasia)|) <br />
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroCPFRG'] == 1){ ?>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCPF"); ?> = (|(cpf_)|) <br />
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRG"); ?> = (|(rg_)|) <br />
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroCNPJ'] == 1){ ?>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCNPJ"); ?> = (|(cnpj_)|) <br />
                <?php } ?>
                <?php if($GLOBALS['habilitarCadastroIEstadualIMunicipal'] == 1){ ?>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoMunicipal"); ?> = (|(i_municipal)|) <br />
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroInscricaoEstadual"); ?> = (|(i_estadual)|) <br />
                <?php } ?>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoPrincipal"); ?> = (|(endereco_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoNumeroPrincipal"); ?> = (|(endereco_numero_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoComplementoPrincipal"); ?> = (|(endereco_complemento_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBairroPrincipal"); ?> = (|(bairro_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCidadePrincipal"); ?> = (|(cidade_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEstadoPrincipal"); ?> = (|(estado_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPaisPrincipal"); ?> = (|(pais_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCEPPrincipal"); ?> = (|(cep_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEmailPrincipal"); ?> = (|(email_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTel"); ?> = (|(tel_ddd_principal)|) - (|(tel_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCel"); ?> = (|(cel_ddd_principal)|) - (|(cel_principal)|) <br />
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFax"); ?> = (|(fax_ddd_principal)|) - (|(fax_principal)|) <br />
                <?php if($GLOBALS['habilitarCadastroSite'] == 1){ ?>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroSitePrincipal"); ?> = (|(site_principal)|) <br />
                <?php } ?>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
              	<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <td width="50" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoConteudo"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                foreach($resultadoConteudo as $linhaConteudo)
                {
                    //echo "id=" . $linhaConteudo['id'] . "<br />";
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaConteudo['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                <td class="TabelaDados01Celula">
                	<?php //Título. ?>
					<?php if($linhaConteudo['tipo_conteudo'] == 1){ ?>
                        <div class="ConteudoTitulo" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                            <h1 style="margin: 0px; padding: 0px; font-size: inherit;">
								<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            </h1>
                        </div>
					<?php } ?>
                    
                	<?php //Subtítulo. ?>
					<?php if($linhaConteudo['tipo_conteudo'] == 2){ ?>
                        <div class="ConteudoSubtitulo" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                            <h2 style="margin: 0px; padding: 0px; font-size: inherit;">
								<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            </h2>
                        </div>
					<?php } ?>
                    
                	<?php //Texto corrido. ?>
					<?php if($linhaConteudo['tipo_conteudo'] == 3){ ?>
                        <div class="ConteudoTexto" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                        </div>
					<?php } ?>
                    
                	<?php //Tab/Recuo. ?>
					<?php if($linhaConteudo['tipo_conteudo'] == 4){ ?>
                        <div class="ConteudoTexto" style="margin-left: 30px; text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                        </div>
					<?php } ?>
                    
                	<?php //Imagem (com e sem redimensionamento). ?>
					<?php //**************************************************************************************?>
					<?php if($linhaConteudo['tipo_conteudo'] == 5 || $linhaConteudo['tipo_conteudo'] == 9){ ?>
                    
						<?php //Imagem para a esquerda. ?>
                        <?php //---------------------- ?>
						<?php if($linhaConteudo['alinhamento_imagem'] == 3){ ?>
                            <div>
                                <?php if($linhaConteudo['arquivo'] <> ""){ ?>
                                    <?php if($linhaConteudo['conteudo_link'] == ""){ ?>
                                        <?php //Sem pop-up. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                        	<?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
											<?php } ?>
                                        	<?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
											<?php } ?>
                                        <?php } ?>
                                    
                                        <?php //SlimBox 2 - JQuery. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                            <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaConteudo['arquivo'];?>" rel="lightbox" title="">
												<?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
                                                <?php } ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
                                                <?php } ?>
                                            </a>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php //Imagem com link. ?>
                                        <a href="<?php echo $linhaConteudo['conteudo_link'];?>" target="_blank">
                                        	<?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
											<?php } ?>
                                        	<?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoEsquerda" />
											<?php } ?>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                <div class="ConteudoTexto" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                </div>
                            </div>
						<?php } ?>
                        <?php //---------------------- ?>
                        
						<?php //Imagem centralizada. ?>
                        <?php //---------------------- ?>
						<?php if($linhaConteudo['alinhamento_imagem'] == 2){ ?>
							<?php if($linhaConteudo['arquivo'] <> ""){ ?>
                                <div align="center">
                                    <?php if($linhaConteudo['conteudo_link'] == ""){ ?>
                                        <?php //Sem pop-up. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                        	<?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
											<?php } ?>
                                        	<?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
											<?php } ?>
                                        <?php } ?>
                                    
                                        <?php //SlimBox 2 - JQuery. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                            <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaConteudo['arquivo'];?>" rel="lightbox" title="">
												<?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                                <?php } ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                                <?php } ?>
                                            </a>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php //Imagem com link. ?>
                                        <a href="<?php echo $linhaConteudo['conteudo_link'];?>" target="_blank">
											<?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                            <?php } ?>
                                            <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" />
                                            <?php } ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="ConteudoLegenda" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            </div>
						<?php } ?>
                        <?php //---------------------- ?>
                        
						<?php //Imagem para a direita. ?>
                        <?php //---------------------- ?>
						<?php if($linhaConteudo['alinhamento_imagem'] == 1){ ?>
                            <div>
                                <?php if($linhaConteudo['arquivo'] <> ""){ ?>
                                    <?php if($linhaConteudo['conteudo_link'] == ""){ ?>
                                        <?php //Sem pop-up. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
											<?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                            <?php } ?>
                                            <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                            <?php } ?>
                                        <?php } ?>
                                    
                                        <?php //SlimBox 2 - JQuery. ?>
                                        <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                            <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaConteudo['arquivo'];?>" rel="lightbox" title="">
												<?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                                <?php } ?>
                                                <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                                <?php } ?>
                                            </a>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php //Imagem com link. ?>
                                        <a href="<?php echo $linhaConteudo['conteudo_link'];?>" target="_blank">
											<?php if($linhaConteudo['tipo_conteudo'] == 5){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/r<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                            <?php } ?>
                                            <?php if($linhaConteudo['tipo_conteudo'] == 9){ ?>
                                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/o<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>" class="ImagemAlinhamentoDireita" />
                                            <?php } ?>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                <div class="ConteudoTexto" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                </div>
                            </div>
						<?php } ?>
                        <?php //---------------------- ?>
                        
					<?php } ?>
					<?php //**************************************************************************************?>
					
                	<?php //Vídeos. ?>
					<?php //**************************************************************************************?>
					<?php if($linhaConteudo['tipo_conteudo'] == 6){ ?>
						<?php //Direto na página. ?>
						<?php if($linhaConteudo['config_arquivo'] == 2){ ?>
							<div class="ConteudoTexto" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
								<?php echo VideoFuncoes::VideoExibirHTML($linhaConteudo['arquivo'], "", "", ""); ?>
							</div>
						<?php } ?>
					<?php } ?>
					<?php //**************************************************************************************?>

                	<?php //HTML. ?>
					<?php //**************************************************************************************?>
                    <?php if($linhaConteudo['tipo_conteudo'] == 7){ ?>
                        <div class="ConteudoTexto" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
                        	<?php
							$flagHTMLYoutube = false;
							
							if(strpos($linhaConteudo['conteudo'], "youtu") !== false)
							{
								$flagHTMLYoutube = true;
							}
							
							?>
                            
                            
                            <?php //Youtube. ?>
                            <?php if($flagHTMLYoutube == true) {?>
								<?php //iframe no conteúdo. ?>
                                <?php if(strpos($linhaConteudo['conteudo'], "iframe") !== false) {?>
                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                    <?php echo str_replace("\\","",$linhaConteudo['conteudo']);?>
                                <?php } ?>
                                
                                <?php //iframe não detectado. ?>
                                
                                <?php if(strpos($linhaConteudo['conteudo'], "iframe") == false) {?>
                                    <iframe width="<?php echo $GLOBALS['configTamanhoVideoW']; ?>" height="<?php echo $GLOBALS['configTamanhoVideoH']; ?>" src="//www.youtube.com/embed/<?php echo str_replace("watch?v=","",Funcoes::ConteudoRetornoArray01($linhaConteudo['conteudo'], 1)); ?>" frameborder="0" allowfullscreen></iframe>
                                    <?php //echo "ConteudoRetornoArray01 = " . ConteudoRetornoArray01($linhaConteudo['conteudo'], 1) . "<br />";?>
                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                <?php } ?>
                            <?php } ?>
                            
                            
                            <?php //HTML. ?>
                            <?php if($flagHTMLYoutube == false) {?>
                            	<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            <?php } ?>
                        </div>
                    <?php } ?>
					<?php //**************************************************************************************?>

                	<?php //Arquivo. ?>
					<?php //**************************************************************************************?>
					<?php if($linhaConteudo['tipo_conteudo'] == 8){ ?>
                        <div class="ConteudoTexto" style="text-align: <?php echo Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);?>;">
							<?php if($linhaConteudo['arquivo'] <> ""){ ?>
                                <?php 
                                //Rotina para ajudar a verificar a extensão do arquivo.
                                $arrArquivoExtensao = explode(".", $linhaConteudo['arquivo']);
                                $arquivoExtensao = strtolower(end($arrArquivoExtensao));
                                ?>
                                
                                <?php //Download. ?>
                                <?php if($linhaConteudo['config_arquivo'] == 3){ ?>
                                    <?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {?>
                                        <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . "o" . $linhaConteudo['arquivo']; //Imagens - incluir 'o' na frente do nome do arquivo.?>" target="_blank" class="ConteudoLinks">
                                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                        </a>
                                    <?php }else{ ?>
                                        <a href="<?php echo "ArquivosDownload.php?nomeArquivo=" . $linhaConteudo['arquivo'];?>" target="_blank" class="ConteudoLinks">
                                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            
                                <?php //Direto para mídia. ?>
                                <?php if($linhaConteudo['config_arquivo'] == 4){ ?>
                                    <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaConteudo['arquivo'];?>" target="_blank" class="ConteudoLinks">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                                    </a>
                                <?php } ?>
                            <?php }else{ ?>
                            	<?php echo Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);?>
                            <?php } ?>
                        </div>
					<?php } ?>
					<?php //**************************************************************************************?>
                    
                	<?php //Divisão de colunas. ?>
					<?php //**************************************************************************************?>
					<?php if($linhaConteudo['tipo_conteudo'] == 10){ ?>
						<?php
						//Teste.
						//$strConteudo = "3";
						//for($countColunas = 1; $countColunas <= $strConteudo; $countColunas++)
						//{
							//echo "countColunas=" . $countColunas . "<br />";
						//}
						
						$countConteudoColunas = 1;
						//Query de pesquisa.
						//----------
						$strSqlConteudoColunasSelect = "";
						$strSqlConteudoColunasSelect .= "SELECT ";
						$strSqlConteudoColunasSelect .= "id, ";
						$strSqlConteudoColunasSelect .= "id_tb_conteudo, ";
						$strSqlConteudoColunasSelect .= "n_classificacao ";
						$strSqlConteudoColunasSelect .= "FROM tb_conteudo_colunas ";
						$strSqlConteudoColunasSelect .= "WHERE id <> 0 ";
						$strSqlConteudoColunasSelect .= "AND id_tb_conteudo = :id_tb_conteudo ";
						//$strSqlConteudoColunasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoConteudo'] . " ";
						
						$statementConteudoColunasSelect = $dbSistemaConPDO->prepare($strSqlConteudoColunasSelect);
						
						if ($statementConteudoColunasSelect !== false)
						{
							$statementConteudoColunasSelect->execute(array(
								"id_tb_conteudo" => $linhaConteudo['id']
							));
						}
						
						//$resultadoConteudo = $dbSistemaConPDO->query($strSqlConteudoSelect);
						$resultadoConteudoColunas = $statementConteudoColunasSelect->fetchAll();
						?>
						
						<?php if(empty($resultadoConteudoColunas)){?>		
						
						<?php }else{ ?>
							<table width="100%" border="0" cellspacing="0" cellpadding="4">
							  <tr>
								<?php 
								foreach($resultadoConteudoColunas as $linhaConteudoColunas)
								{ 
								?>
									<td valign="top">
										<div align="center" class="ConteudoTexto">
											<a href="ConteudoIndice.php?idParentConteudo=<?php echo $linhaConteudoColunas['id']; ?>" target="_blank" class="ConteudoLinks">
												<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoColunasEditar"); ?>: <?php echo $countConteudoColunas; ?>
											</a>
										</div>
									</td>
								<?php 
									$countConteudoColunas++;
								} 
								?>
							  </tr>
							</table>
							
						<?php 
						} 
						
						//Limpeza de objetos.
						unset($strSqlConteudoColunasSelect);
						unset($statementConteudoColunasSelect);
						unset($resultadoConteudoColunas);
						unset($linhaConteudoColunas);
						//----------
						?>
						
					<?php } ?>
					<?php //**************************************************************************************?>
					
                	<?php //SWF. ?>
					<?php //**************************************************************************************?>
					<?php if($linhaConteudo['tipo_conteudo'] == 11){ ?>
						<div align="center">
							<?php
							$arrDimensaoArquivo = explode(",", $linhaConteudo['dimensao_arquivo']);
							$swfW = $arrDimensaoArquivo[0];
							$swfH = $arrDimensaoArquivo[1];
							?>		
										
							<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>">
								<param name="movie" value="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>">
								<param name="quality" value="high">
								<embed src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaConteudo['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>"></embed>
							</object>
						</div>
					<?php } ?>
					<?php //**************************************************************************************?>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="ConteudoEditar.php?idTbConteudo=<?php echo $linhaConteudo['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaConteudo['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
    <?php } ?>
	
	<script type="text/javascript">
		$(document).ready(function () {
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formConteudo').validate({ //Inicialização do plug-in.
			
			
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
					}//,
					//field2: {
						//required: true,
						//minlength: 5
					//}
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					}
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
    <form name="formConteudo" id="formConteudo" action="ConteudoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
    <?php //echo "habilitarCategoriasNClassificacao=" . $GLOBALS['habilitarCategoriasNClassificacao'] . "<br />"; ?>
		<table class="TabelaCampos01">
			<tr class="TbFundoEscuro">
				<td class="TabelaCampos01Celula" colspan="4">
					<div align="center" class="Texto02">
						<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbConteudo"); ?>
						</strong>
					</div>
				</td>
			</tr>
			<tr>
				<td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
					<div align="left" class="Texto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro TabelaCampos01Celula">
					<div align="left" class="Texto01">
						<div style="display: inline;">
							<input name="tipo_conteudo" type="radio" value="1" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao1"); ?>
						</div>
						<div style="display: inline;">
							<input name="tipo_conteudo" type="radio" value="2" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao2"); ?>
						</div>
						<div style="display: inline;">
							<input name="tipo_conteudo" type="radio" value="3" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao3"); ?>
						</div>
						<div style="display: inline;">
							<input name="tipo_conteudo" type="radio" value="4" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao4"); ?>
						</div>
						<div style="display: inline;">
							<input name="tipo_conteudo" type="radio" value="7" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoFormatacao7"); ?>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
					<div align="left" class="Texto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro TabelaCampos01Celula">
					<div align="left" class="Texto01">
						<div style="display: inline;">
							<input name="alinhamento_texto" type="radio" value="3" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento3"); ?>
						</div>
						<div style="display: inline;">
							<input name="alinhamento_texto" type="radio" value="2" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento2"); ?>
						</div>
						<div style="display: inline;">
							<input name="alinhamento_texto" type="radio" value="1" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento1"); ?>
						</div>
						<div style="display: inline;">
							<input name="alinhamento_texto" type="radio" value="4" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento4"); ?>
						</div>
					</div>
				</td>
			</tr>
			<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
					<div align="left" class="Texto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro TabelaCampos01Celula">
					<div>
						<input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
					</div>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoConteudo"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro">
					<div>
						<?php //Sem formatação.?>
						<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
							<textarea name="conteudo" id="conteudo" class="CampoTextoMultilinhaConteudo"></textarea>
						<?php } ?>
						
						<?php //Formatação básica (CLEditor).?>
						<?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
							
							<script type="text/javascript">
								//Caixa básica.
								$(document).ready(function () {
									$("#conteudo").cleditor(
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
							<textarea name="conteudo" id="conteudo"></textarea>
						<?php } ?>
						
						<?php //Formatação avançada (CLEditor).?>
						<?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
							<script type="text/javascript">
								$(document).ready(function () {
									$("#conteudo").cleditor(
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
							<textarea name="conteudo" id="conteudo"></textarea>
						<?php } ?>
					</div>
				</td>
			</tr>
		</table>
		<div>
			<div style="float:left;">
				<input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
				
				<input name="config_arquivo" type="hidden" id="config_arquivo" value="2" />
				<input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentConteudo; ?>" />
				<input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
				<input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
			<div style="float:right;">
				&nbsp;
			</div>
		</div>
    </form>
    
    <br />
    
	<script type="text/javascript">
		$(document).ready(function () {
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formConteudoImagem').validate({ //Inicialização do plug-in.
			
			
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
					}//,
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					}
				},		
				//----------------------
				
			});
			//**************************************************************************************

		});	
	</script>
    <form name="formConteudoImagem" id="formConteudoImagem" action="ConteudoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbImagem"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamentoImagem"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
					<div align="left" class="Texto01">
						<div style="display: inline;">
							<input name="alinhamento_imagem" type="radio" value="3" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamentoImagem3"); ?>
						</div>
						<div style="display: inline;">
							<input name="alinhamento_imagem" type="radio" value="2" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamentoImagem2"); ?>
						</div>
						<div style="display: inline;">
							<input name="alinhamento_imagem" type="radio" value="1" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamentoImagem1"); ?>
						</div>
					</div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
					<div align="left" class="Texto01">
						<div style="display: inline;">
							<input name="alinhamento_texto" type="radio" value="3" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento3"); ?>
						</div>
						<div style="display: inline;">
							<input name="alinhamento_texto" type="radio" value="2" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento2"); ?>
						</div>
						<div style="display: inline;">
							<input name="alinhamento_texto" type="radio" value="1" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento1"); ?>
						</div>
						<div style="display: inline;">
							<input name="alinhamento_texto" type="radio" value="4" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento4"); ?>
						</div>
					</div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
					<div>
						<input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
					</div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarConteudoImagemSemRedimensionamento'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoDimensaoImagem"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
					<div align="left" class="Texto01">
						<div style="display: inline;">
							<input name="tipo_conteudo" type="radio" value="9" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoDimensaoImagemSim"); ?>
						</div>
						<div style="display: inline;">
							<input name="tipo_conteudo" type="radio" value="5" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoDimensaoImagemNao"); ?>
						</div>
					</div>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoLegenda"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
					<div>
						<?php //Sem formatação.?>
						<?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
							<textarea name="conteudo" id="conteudo" class="CampoTextoMultilinhaConteudo"></textarea>
						<?php } ?>
						
						<?php //Formatação básica (CLEditor).?>
						<?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
							
							<script type="text/javascript">
								//Caixa básica.
								$(document).ready(function () {
									$("#conteudo_imagem").cleditor(
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
							<textarea name="conteudo_imagem" id="conteudo_imagem"></textarea>
						<?php } ?>
						
						<?php //Formatação avançada (CLEditor).?>
						<?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
							<script type="text/javascript">
								$(document).ready(function () {
									$("#conteudo_imagem").cleditor(
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
							<textarea name="conteudo_imagem" id="conteudo_imagem"></textarea>
						<?php } ?>
					</div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL01"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left" class="Texto01">
                    	<textarea name="conteudo_link" id="conteudo_link" class="CampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                    </div>
                </td>
            </tr>

            <tr ID="cell_imagem">
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div>
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                    </div>
                </td>
            </tr>
        </table>
		<div>
			<div style="float:left;">
				<input type="image" name="submit" value="Submit" src="img/btoUpload.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoUpload"); ?>" />
				<?php if($GLOBALS['habilitarConteudoImagemSemRedimensionamento'] == 0){ ?>
                    <input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="5" />
				<?php } ?>
                <input name="config_arquivo" type="hidden" id="config_arquivo" value="2" />
				<input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentConteudo; ?>" />
				<input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
				<input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
			<div style="float:right;">
				&nbsp;
			</div>
		</div>
    </form>
    
	
	<?php if($GLOBALS['habilitarConteudoVideos'] == 1){ ?>
        <br />
        <script type="text/javascript">
            $(document).ready(function () {
            
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formConteudoVideos').validate({ //Inicialização do plug-in.
                
                
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
                        }//,
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
                        n_classificacao: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        }
                    },		
                    //----------------------
                    
                });
                //**************************************************************************************
    
            });	
        </script>
        <form name="formConteudoVideos" id="formConteudoVideos" action="ConteudoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbVideo"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left" class="Texto01">
                            <div style="display: inline;">
                                <input name="alinhamento_texto" type="radio" value="3" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento3"); ?>
                            </div>
                            <div style="display: inline;">
                                <input name="alinhamento_texto" type="radio" value="2" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento2"); ?>
                            </div>
                            <div style="display: inline;">
                                <input name="alinhamento_texto" type="radio" value="1" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento1"); ?>
                            </div>
                        </div>
                    </td>
                </tr>
				
				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
				
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoVideo"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                        </div>
                    </td>
                </tr>

            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoUpload.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoUpload"); ?>" />
                    
                    <input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="6" />
                    <input name="config_arquivo" type="hidden" id="config_arquivo" value="2" />

                    <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentConteudo; ?>" />
                    <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
    <?php } ?>  

    
	<?php if($GLOBALS['habilitarConteudoArquivos'] == 1){ ?>
        <br />
        <script type="text/javascript">
            $(document).ready(function () {
            
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formConteudoArquivos').validate({ //Inicialização do plug-in.
                
                
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
                        }//,
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
                        n_classificacao: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        }
                    },		
                    //----------------------
                    
                });
                //**************************************************************************************
    
            });	
        </script>
        <form name="formConteudoArquivos" id="formConteudoArquivos" action="ConteudoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbArquivos"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left" class="Texto01">
                            <div style="display: inline;">
                                <input name="config_arquivo" type="radio" value="3" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao3"); ?>
                            </div>
                            <div style="display: inline;">
                                <input name="config_arquivo" type="radio" value="4" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao4"); ?>
                            </div>
                        </div>                    
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left" class="Texto01">
                            <div style="display: inline;">
                                <input name="alinhamento_texto" type="radio" value="3" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento3"); ?>
                            </div>
                            <div style="display: inline;">
                                <input name="alinhamento_texto" type="radio" value="2" class="CampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento2"); ?>
                            </div>
                            <div style="display: inline;">
                                <input name="alinhamento_texto" type="radio" value="1" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento1"); ?>
                            </div>
                            <div style="display: inline;">
                                <input name="alinhamento_texto" type="radio" value="4" class="CampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoAlinhamento4"); ?>
                            </div>
                        </div>
                    </td>
                </tr>

				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                        </div>
                    </td>
                </tr>
                <?php } ?>

                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemTextoLink"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div align="left">
                        	<textarea name="conteudo" id="conteudo" class="CampoTextoMultilinhaURL"></textarea>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivo"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoUpload.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoUpload"); ?>" />
                    
                    <input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="8" />

                    <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentConteudo; ?>" />
                    <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
    <?php } ?>  
    
    
	<?php if($GLOBALS['habilitarConteudoColunas'] == 1){ ?>
        <br />
        <script type="text/javascript">
            $(document).ready(function () {
            
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formConteudoColunas').validate({ //Inicialização do plug-in.
                
                
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
                        conteudo: {
                            required: true,
                            number: true
                        }
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
                        n_classificacao: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
                        conteudo: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        }
                    },		
                    //----------------------
                    
                });
                //**************************************************************************************
    
            });	
        </script>
        <form name="formConteudoColunas" id="formConteudoColunas" action="ConteudoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbColunas"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoNColunas"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="text" name="conteudo" id="conteudo" class="CampoNumerico01" maxlength="3" value="3" />
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                    
                    <input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="10" />
					<input name="config_arquivo" type="hidden" id="config_arquivo" value="2" />
                    <input name="alinhamento_texto" type="hidden" id="alinhamento_texto" value="0" />
                    
                    <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentConteudo; ?>" />
                    <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
    <?php } ?>  
    
    
	<?php if($GLOBALS['habilitarConteudoSwf'] == 1){ ?>
        <br />
		<script type="text/javascript">
            $(document).ready(function () {
            
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formConteudoSWF').validate({ //Inicialização do plug-in.
                
                
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
                        dimensao_w: {
                            required: true,
                            number: true
                        },
                        dimensao_h: {
                            required: true,
                            number: true
                        }
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        //n_classificacao: "Please specify your name"//,
                        n_classificacao: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
                        dimensao_w: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
                        dimensao_h: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        }
                    },		
                    //----------------------
                    
                });
                //**************************************************************************************
    
            });	
        </script>
        <form name="formConteudoSWF" id="formConteudoSWF" action="ConteudoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="2">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoTbSWF"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarConteudoNClassificacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemDimensoes"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div class="Texto01">
                          <input name="dimensao_w" type="text" id="dimensao_w" class="CampoNumerico01" size="5" maxlength="5" value="100"> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemLarguraPixels"); ?>
                          <input name="dimensao_h" type="text"  id="dimensao_w" class="CampoNumerico01"size="5" maxlength="5" value="100"> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAlturaPixels"); ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaConteudoSWF"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro">
                        <div>
                            <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01" />
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoUpload.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoUpload"); ?>" />
                    
                    <input name="tipo_conteudo" type="hidden" id="tipo_conteudo" value="11" />
                    <input name="alinhamento_texto" type="hidden" id="alinhamento_texto" value="2" />
                    <input name="config_arquivo" type="hidden" id="config_arquivo" value="2" />

                    <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentConteudo; ?>" />
                    <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $idTbCadastro; ?>" />
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
    <?php } ?>  
    
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlConteudoSelect);
unset($statementConteudoSelect);
unset($resultadoConteudo);
unset($linhaConteudo);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>