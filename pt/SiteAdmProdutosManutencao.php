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
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$tipoComplemento = $_GET["tipoComplemento"];
$idItem = $_GET["idItem"];
$configCaixaSelecao = $_GET["configCaixaSelecao"];

$paginaRetorno = "SiteAdmProdutosManutencao.php";
$funcaoRetorno = $_GET["funcaoRetorno"];

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno .
"&idItem=" . $idItem . 
"&configCaixaSelecao=" . $configCaixaSelecao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Seleção de ids selecionados para o registro.
$arrProdutosFiltroGenericoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idItem, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", $tipoComplemento, "", ",", "", "1"));


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
//echo "cookie(idTbProdutosCliente)=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbProdutosCliente"] . "<br>";
//echo "configCaixaSelecao=" . $configCaixaSelecao . "<br>";
//echo "funcaoRetorno=" . $funcaoRetorno . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosManutencaoTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosManutencaoTitulo"); ?>
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
    
	<?php if($masterPageSiteSelect <> "LayoutSiteIFrame.php"){ ?>
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
	<?php } ?>

	<?php //Produtos - Filtros Genérico.?>
    <?php //----------?>
    <?php //if($GLOBALS['habilitarProdutosFiltroGenerico01'] == 1){ ?>
        <?php
		//Definição de variáveis.
		//$tipoComplemento = 12;
		
        //Query de pesquisa.
        //----------
        $strSqlProdutosManutencaoSelect = "";
        $strSqlProdutosManutencaoSelect .= "SELECT ";
        $strSqlProdutosManutencaoSelect .= "id, ";
        $strSqlProdutosManutencaoSelect .= "tipo_complemento, ";
        $strSqlProdutosManutencaoSelect .= "complemento, ";
        $strSqlProdutosManutencaoSelect .= "descricao ";
        $strSqlProdutosManutencaoSelect .= "FROM tb_produtos_complemento ";
        $strSqlProdutosManutencaoSelect .= "WHERE id <> 0 ";
        $strSqlProdutosManutencaoSelect .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlProdutosManutencaoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
        $strSqlProdutosManutencaoSelect .= "ORDER BY complemento";
        
        $statementProdutosManutencaoSelect = $dbSistemaConPDO->prepare($strSqlProdutosManutencaoSelect);
        
        if ($statementProdutosManutencaoSelect !== false)
        {
            $statementProdutosManutencaoSelect->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoProdutosManutencao = $dbSistemaConPDO->query($strSqlProdutosManutencaoSelect);
        $resultadoProdutosManutencao = $statementProdutosManutencaoSelect->fetchAll();
        ?>
        
        <!--table border="0" width="100%" cellpadding="0" cellspacing="0" class="AdmTabelaDados01">
            <tr class="AdmTbFundoEscuro">
                <td>
                    <div align="center" class="AdmTexto02">
                    	<?php if($tipoComplemento == "4"){ ?>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus"); ?>
                        <?php } ?>

                    	<?php if($tipoComplemento == "12"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "13"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "14"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "15"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "16"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "17"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "18"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "19"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "20"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "21"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "22"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "23"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "24"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "25"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "26"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "27"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "28"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "29"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "30"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "31"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "32"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "33"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "34"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "35"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "36"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "37"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "38"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "39"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "40"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "41"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>
                        <?php } ?>

                    </div>
                </td>
            </tr>
        </table-->
		<?php
        if(empty($resultadoProdutosManutencao))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmAlerta">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemRegistrosVazio"); ?>
            </div>
		<?php } ?>
        <?php
        //}else{
        ?>
        <form name="formProdutosManutencaoAcoes" id="formProdutosManutencaoAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_produtos_complemento" />
            <input name="tipoComplemento" type="hidden" id="tipoComplemento" value="<?php echo $tipoComplemento; ?>" />
            <input name="idItem" type="hidden" id="idItem" value="<?php echo $idItem; ?>" />
            <input name="configCaixaSelecao" type="hidden" id="configCaixaSelecao" value="<?php echo $configCaixaSelecao; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: left;">
                    <div class="AdmDivBto01" onclick="btoClick_onEvent('btoProdutosManutencaoExcluir');">
                        <a class="AdmLinks01">
                            Remover
                        </a>
                    </div>
                    <input id="btoProdutosManutencaoExcluir" type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" style="display: none;"/>
                </div>
                <div align="right" style="float: left;">
                	<?php if($funcaoRetorno == "1"){ ?>
                    <script type="text/javascript">
						//onclick="parent.btoClick_onEvent('linkManutencaoAjaxFechar');"
						
						//(function($){
							parent.btoClick_onEvent('linkManutencaoAjaxFechar');
						//})(jQuery);
					</script>
                	<?php } ?>
                    
                    <div class="AdmDivBto01" onclick="btoClick_onEvent('btoProdutosManutencaoSelecionar');">
                        <a class="AdmLinks01">
                            Anexar / Fechar
                        </a>
                    </div>
                    <input id="btoProdutosManutencaoSelecionar" type="image" name="btoSelecionar" value="Submit"  src="img/btoAnexar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSalvar"); ?>" style="display: none;"/>
                </div>
            </div>
        
            <table width="100%" class="AdmTabelaDados01">
              <tr class="">
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula"<?php if($configCaixaSelecao == "3"){ ?> style="display: none;"<?php } ?>>
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
				
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                    	<?php if($tipoComplemento == "4"){ ?>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus"); ?>
                        <?php } ?>

                    	<?php if($tipoComplemento == "12"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "13"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "14"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "15"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "16"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "17"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "18"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "19"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "20"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "21"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "22"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "23"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "24"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "25"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "26"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "27"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "28"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "29"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "30"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "31"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "32"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "33"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "34"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "35"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "36"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "37"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "38"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "39"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "40"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "41"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoProdutosManutencao as $linhaProdutosManutencao)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="">
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaProdutosManutencao['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmProdutosManutencaoEditar.php?idTbProdutosComplemento=<?php echo $linhaProdutosManutencao['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            <img src="img/btoEditar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>" />
                        </a>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula"<?php if($configCaixaSelecao == "3"){ ?> style="display: none;"<?php } ?>>
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaProdutosManutencao['id'];?>" <?php if(in_array($linhaProdutosManutencao['id'], $arrProdutosFiltroGenericoSelecao)){ ?> checked="checked"<?php } ?> class="AdmCampoCheckBox01" />
                        <!--input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaProdutosManutencao['id'];?>" class="AdmCampoRadioButton01" /-->
                    </div>
                </td>

                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutosManutencao['complemento']);?>
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php //} ?>
        
        <form name="formProdutosManutencao" id="formProdutosManutencao" action="SiteAdmProdutosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="2">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserir"); ?> - 
                                
								<?php if($tipoComplemento == "4"){ ?>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus"); ?>
                                <?php } ?>
        
								<?php if($tipoComplemento == "12"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "13"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "14"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "15"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "16"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "17"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "18"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "19"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "20"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "21"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                
                                <?php if($tipoComplemento == "22"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "23"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "24"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "25"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "26"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "27"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "28"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "29"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "30"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "31"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                
                                <?php if($tipoComplemento == "32"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "33"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "34"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "35"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "36"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "37"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "38"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "39"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "40"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "41"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
							<?php if($tipoComplemento == "4"){ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus"); ?>
                            <?php } ?>
    
							<?php if($tipoComplemento == "12"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "13"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "14"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "15"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "16"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "17"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "18"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "19"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "20"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "21"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            
                            <?php if($tipoComplemento == "22"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico11Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "23"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico12Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "24"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico13Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "25"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico14Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "26"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico15Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "27"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico16Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "28"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico17Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "29"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico18Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "30"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico19Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "31"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico20Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            
                            <?php if($tipoComplemento == "32"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico21Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "33"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico22Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "34"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico23Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "35"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico24Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "36"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico25Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "37"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico26Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "38"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico27Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "39"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico28Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "40"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico29Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "41"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico30Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr style="display: none;">
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <div class="AdmDivBto01" onclick="btoClick_onEvent('btoProdutosManutencaoIncluir');">
                        <a class="AdmLinks01">
                            Incluir
                        </a>
                    </div>
                    <input id="btoProdutosManutencaoIncluir" type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" style="display: none;" />
                    
                    <input type="hidden" id="tipo_complemento" name="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input type="hidden" id="idItem" name="idItem" value="<?php echo $idItem; ?>" />
                    <input type="hidden" id="configCaixaSelecao" name="configCaixaSelecao" value="<?php echo $configCaixaSelecao; ?>" />
                    
                    <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlProdutosManutencaoSelect);
        unset($statementProdutosManutencaoSelect);
        unset($resultadoProdutosManutencao);
        unset($linhaProdutosManutencao);
        //----------
        ?>
	<?php //} ?>
    <?php //----------?>
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