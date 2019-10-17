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

$paginaRetorno = "SiteAdmHistoricoManutencao.php";
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
$arrHistoricoFiltroGenericoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($idItem, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", $tipoComplemento, "", ",", "", "1"));


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
//echo "cookie(idTbHistoricoCliente)=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbHistoricoCliente"] . "<br>";
//echo "configCaixaSelecao=" . $configCaixaSelecao . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoManutencaoTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoManutencaoTitulo"); ?>
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


	<?php //Histórico - Filtros Genérico.?>
    <?php //----------?>
    <?php //if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1){ ?>
        <?php
		//Definição de variáveis.
		//$tipoComplemento = 12;
		
        //Query de pesquisa.
        //----------
        $strSqlHistoricoManutencaoSelect = "";
        $strSqlHistoricoManutencaoSelect .= "SELECT ";
        $strSqlHistoricoManutencaoSelect .= "id, ";
        $strSqlHistoricoManutencaoSelect .= "tipo_complemento, ";
        $strSqlHistoricoManutencaoSelect .= "complemento, ";
        $strSqlHistoricoManutencaoSelect .= "descricao ";
        $strSqlHistoricoManutencaoSelect .= "FROM tb_historico_complemento ";
        $strSqlHistoricoManutencaoSelect .= "WHERE id <> 0 ";
        $strSqlHistoricoManutencaoSelect .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlHistoricoManutencaoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoHistorico'] . " ";
        $strSqlHistoricoManutencaoSelect .= "ORDER BY complemento";
        
        $statementHistoricoManutencaoSelect = $dbSistemaConPDO->prepare($strSqlHistoricoManutencaoSelect);
        
        if ($statementHistoricoManutencaoSelect !== false)
        {
            $statementHistoricoManutencaoSelect->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoHistoricoManutencao = $dbSistemaConPDO->query($strSqlHistoricoManutencaoSelect);
        $resultadoHistoricoManutencao = $statementHistoricoManutencaoSelect->fetchAll();
        ?>
        
        <!--table border="0" width="100%" cellpadding="0" cellspacing="0" class="AdmTabelaDados01">
            <tr class="AdmTbFundoEscuro">
                <td>
                    <div align="center" class="AdmTexto02">
                    	<?php if($tipoComplemento == "4"){ ?>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>
                        <?php } ?>

                    	<?php if($tipoComplemento == "12"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "13"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "14"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "15"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "16"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "17"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "18"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "19"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "20"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "21"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "22"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "23"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "24"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "25"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "26"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "27"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "28"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "29"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "30"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "31"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "32"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "33"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "34"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "35"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "36"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "37"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "38"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "39"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "40"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "41"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "42"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "43"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "44"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "45"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "46"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "47"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "48"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "49"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "50"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "51"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "52"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "53"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "54"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "55"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "56"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "57"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "58"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "59"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "60"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "61"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "62"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "63"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "64"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "65"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "66"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "67"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "68"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "69"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "70"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "71"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "72"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "73"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "74"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "75"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "76"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "77"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "78"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "79"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "80"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "81"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "82"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "83"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "84"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "85"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "86"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "87"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "88"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "89"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "90"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "91"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        </table-->
		<?php
        if(empty($resultadoHistoricoManutencao))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmAlerta">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemRegistrosVazio"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formHistoricoManutencaoAcoes" id="formHistoricoManutencaoAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_historico_complemento" />
            <input name="tipoComplemento" type="hidden" id="tipoComplemento" value="<?php echo $tipoComplemento; ?>" />
            <input name="idItem" type="hidden" id="idItem" value="<?php echo $idItem; ?>" />
            <input name="configCaixaSelecao" type="hidden" id="configCaixaSelecao" value="<?php echo $configCaixaSelecao; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: left;">
                    <div class="AdmDivBto01" onclick="btoClick_onEvent('btoHistoricoManutencaoExcluir');">
                        <a class="AdmLinks01">
                            Remover
                        </a>
                    </div>
                    <input id="btoHistoricoManutencaoExcluir" type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>" style="display: none;"/>
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
                    
                    <div class="AdmDivBto01" onclick="btoClick_onEvent('btoHistoricoManutencaoSelecionar');">
                        <a class="AdmLinks01">
                            Anexar / Fechar
                        </a>
                    </div>
                    <input id="btoHistoricoManutencaoSelecionar" type="image" name="btoSelecionar" value="Submit"  src="img/btoAnexar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSalvar"); ?>" style="display: none;" />
                </div>
            </div>
        
            <table width="100%" class="AdmTabelaDados01">
              <tr class="">
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmErro">
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
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>
                        <?php } ?>

                    	<?php if($tipoComplemento == "12"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "13"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "14"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "15"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "16"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "17"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "18"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "19"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "20"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "21"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "22"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "23"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "24"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "25"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "26"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "27"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "28"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "29"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "30"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "31"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "32"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "33"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "34"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "35"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "36"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "37"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "38"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "39"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "40"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "41"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "42"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "43"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "44"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "45"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "46"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "47"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "48"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "49"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "50"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "51"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "52"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "53"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "54"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "55"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "56"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "57"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "58"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "59"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "60"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "61"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "62"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "63"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "64"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "65"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "66"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "67"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "68"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "69"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "70"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "71"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "72"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "73"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "74"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "75"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "76"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "77"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "78"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "79"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "80"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "81"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                        
                    	<?php if($tipoComplemento == "82"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "83"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "84"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "85"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "86"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "87"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "88"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "89"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "90"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "91"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoHistoricoManutencao as $linhaHistoricoManutencao)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="">
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmHistoricoManutencaoEditar.php?idTbHistoricoComplemento=<?php echo $linhaHistoricoManutencao['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            <img src="img/btoEditar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>" />
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula"<?php if($configCaixaSelecao == "3"){ ?> style="display: none;"<?php } ?>>
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaHistoricoManutencao['id'];?>" <?php if(in_array($linhaHistoricoManutencao['id'], $arrHistoricoFiltroGenericoSelecao)){ ?> checked="checked"<?php } ?> class="AdmCampoCheckBox01" />
                        <!--input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaHistoricoManutencao['id'];?>" class="AdmCampoRadioButton01" /-->
                    </div>
                </td>

                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoManutencao['complemento']);?>
                    </div>
                </td>
                
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formHistoricoManutencao" id="formHistoricoManutencao" action="SiteAdmHistoricoManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="2">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserir"); ?> - 
                                
								<?php if($tipoComplemento == "4"){ ?>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>
                                <?php } ?>
        
                                <?php if($tipoComplemento == "12"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "13"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "14"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "15"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "16"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "17"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "18"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "19"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "20"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "21"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                
                                <?php if($tipoComplemento == "22"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "23"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "24"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "25"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "26"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "27"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "28"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "29"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "30"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "31"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                
                                <?php if($tipoComplemento == "32"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "33"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "34"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "35"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "36"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "37"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "38"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "39"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "40"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "41"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                
                                <?php if($tipoComplemento == "42"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "43"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "44"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "45"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "46"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "47"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "48"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "49"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "50"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "51"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                
                                <?php if($tipoComplemento == "52"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "53"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "54"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "55"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "56"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "57"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "58"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "59"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "60"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "61"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                
                                <?php if($tipoComplemento == "62"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "63"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "64"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "65"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "66"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "67"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "68"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "69"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "70"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "71"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                
                                <?php if($tipoComplemento == "72"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "73"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "74"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "75"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "76"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "77"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "78"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "79"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "80"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "81"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                
                                <?php if($tipoComplemento == "82"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "83"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "84"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "85"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "86"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "87"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "88"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "89"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "90"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "91"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>
                                <?php } ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
							<?php if($tipoComplemento == "4"){ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>
                            <?php } ?>
    
                            <?php if($tipoComplemento == "12"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "13"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "14"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "15"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "16"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "17"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "18"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "19"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "20"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "21"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            
                            <?php if($tipoComplemento == "22"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "23"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "24"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "25"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "26"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "27"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "28"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "29"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "30"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "31"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            
                            <?php if($tipoComplemento == "32"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "33"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "34"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "35"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "36"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "37"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "38"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "39"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "40"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "41"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            
                            <?php if($tipoComplemento == "42"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "43"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "44"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "45"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "46"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "47"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "48"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "49"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "50"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "51"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            
                            <?php if($tipoComplemento == "52"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "53"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "54"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "55"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "56"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "57"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "58"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "59"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "60"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "61"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            
                            <?php if($tipoComplemento == "62"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "63"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "64"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "65"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "66"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "67"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "68"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "69"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "70"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "71"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            
                            <?php if($tipoComplemento == "72"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "73"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "74"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "75"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "76"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "77"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "78"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "79"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "80"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "81"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            
                            <?php if($tipoComplemento == "82"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "83"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "84"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "85"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "86"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "87"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "88"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "89"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "90"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>
                            <?php } ?>
                            <?php if($tipoComplemento == "91"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoManutencaoDescricao"); ?>:
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
                    <div class="AdmDivBto01" onclick="btoClick_onEvent('btoHistoricoManutencaoIncluir');">
                        <a class="AdmLinks01">
                            Incluir
                        </a>
                    </div>
                    <input id="btoHistoricoManutencaoIncluir" type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" style="display: none;" />
                    
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input type="hidden" id="idItem" name="idItem" value="<?php echo $idItem; ?>" />
                    <input type="hidden" id="configCaixaSelecao" name="configCaixaSelecao" value="<?php echo $configCaixaSelecao; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlHistoricoManutencaoSelect);
        unset($statementHistoricoManutencaoSelect);
        unset($resultadoHistoricoManutencao);
        unset($linhaHistoricoManutencao);
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