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
$idTbCadastroContatos = $_GET["idTbCadastroContatos"];
$idTbCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastroContatos, "tb_cadastro_contatos", "id_tb_cadastro");

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteAdmCadastroContatosIndice.php";
$paginaRetornoExclusao = "SiteAdmCadastroContatosEditar.php";
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
$strSqlCadastroContatosDetalhesSelect = "";
$strSqlCadastroContatosDetalhesSelect .= "SELECT ";
//$strSqlCadastroContatosDetalhesSelect .= "* ";
$strSqlCadastroContatosDetalhesSelect .= "id, ";
$strSqlCadastroContatosDetalhesSelect .= "id_tb_cadastro, ";
$strSqlCadastroContatosDetalhesSelect .= "filial, ";
$strSqlCadastroContatosDetalhesSelect .= "nome, ";
$strSqlCadastroContatosDetalhesSelect .= "departamento, ";
$strSqlCadastroContatosDetalhesSelect .= "tel_ddd, ";
$strSqlCadastroContatosDetalhesSelect .= "tel, ";
$strSqlCadastroContatosDetalhesSelect .= "cel_ddd, ";
$strSqlCadastroContatosDetalhesSelect .= "cel, ";
$strSqlCadastroContatosDetalhesSelect .= "email, ";
$strSqlCadastroContatosDetalhesSelect .= "contato_senha, ";
$strSqlCadastroContatosDetalhesSelect .= "obs, ";
$strSqlCadastroContatosDetalhesSelect .= "ativacao, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar1, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar2, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar3, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar4, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar5, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar6, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar7, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar8, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar9, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar10, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar11, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar12, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar13, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar14, ";
$strSqlCadastroContatosDetalhesSelect .= "informacao_complementar15 ";
$strSqlCadastroContatosDetalhesSelect .= "FROM tb_cadastro_contatos ";
$strSqlCadastroContatosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlCadastroContatosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlCadastroContatosDetalhesSelect .= "AND id = :id ";
//$strSqlCadastroContatosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroContatos'] . " ";


$statementCadastroContatosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCadastroContatosDetalhesSelect);

if ($statementCadastroContatosDetalhesSelect !== false)
{
	$statementCadastroContatosDetalhesSelect->execute(array(
		"id" => $idTbCadastroContatos
	));
}

//$resultadoCadastroContatosDetalhes = $dbSistemaConPDO->query($strSqlCadastroContatosDetalhesSelect);
$resultadoCadastroContatosDetalhes = $statementCadastroContatosDetalhesSelect->fetchAll();

if (empty($resultadoCadastroContatosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoCadastroContatosDetalhes as $linhaCadastroContatosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbCadastroContatosId = $linhaCadastroContatosDetalhes['id'];
		$tbCadastroContatosIdTbCadastro = $linhaCadastroContatosDetalhes['id_tb_cadastro'];
		$tbCadastroContatosFilial = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['filial']);
		$tbCadastroContatosNome = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['nome']);
		$tbCadastroContatosDepartamento = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['departamento']);
		$tbCadastroContatosTelDDD = $linhaCadastroContatosDetalhes['tel_ddd'];
		$tbCadastroContatosTel = $linhaCadastroContatosDetalhes['tel'];
		$tbCadastroContatosCelDDD = $linhaCadastroContatosDetalhes['cel_ddd'];
		$tbCadastroContatosCel = $linhaCadastroContatosDetalhes['cel'];
		$tbCadastroContatosEMail = $linhaCadastroContatosDetalhes['email'];
		$tbCadastroContatosContatoSenha = $linhaCadastroContatosDetalhes['contato_senha'];
		$tbCadastroContatosOBS = $linhaCadastroContatosDetalhes['obs'];
		$tbCadastroContatosAtivacao = $linhaCadastroContatosDetalhes['ativacao'];
		$tbCadastroContatosIC1 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar1']);
		$tbCadastroContatosIC2 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar2']);
		$tbCadastroContatosIC3 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar3']);
		$tbCadastroContatosIC4 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar4']);
		$tbCadastroContatosIC5 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar5']);
		$tbCadastroContatosIC6 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar6']);
		$tbCadastroContatosIC7 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar7']);
		$tbCadastroContatosIC8 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar8']);
		$tbCadastroContatosIC9 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar9']);
		$tbCadastroContatosIC10 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar10']);
		$tbCadastroContatosIC11 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar11']);
		$tbCadastroContatosIC12 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar12']);
		$tbCadastroContatosIC13 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar13']);
		$tbCadastroContatosIC14 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar14']);
		$tbCadastroContatosIC15 = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['informacao_complementar15']);
		
		//Verificação de erro.
		//echo "tbCadastroContatosId=" . $tbCadastroContatosId . "<br>";
		//echo "tbCadastroContatosNome=" . $tbCadastroContatosNome . "<br>";
	}
}


//Definição de variáveis.
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosEditarTitulo");
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);
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


    <form name="formCadastroContatosEditar" id="formCadastroContatosEditar" action="SiteAdmCadastroContatosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="AdmTabelaDados01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosTbContatoEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarCadastroContatosFilial'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosFilial"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="filial" id="filial" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosFilial; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosNome"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="nome" id="nome" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosNome; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosDepartamento"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="departamento" id="departamento" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosDepartamento; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosTel"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            (<input type="text" name="tel_ddd" id="tel_ddd" class="AdmCampoDDD01" maxlength="255" value="<?php echo $tbCadastroContatosTelDDD; ?>" />)
                            <input type="text" name="tel" id="tel" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosTel; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosCel"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            (<input type="text" name="cel_ddd" id="cel_ddd" class="AdmCampoDDD01" maxlength="255" value="<?php echo $tbCadastroContatosCelDDD; ?>" />)
                            <input type="text" name="cel" id="cel" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosCel; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosEMail"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="email" id="email" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosEMail; ?>" />
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarCadastroContatosIc1'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc1']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC1;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC1;?></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbCadastroContatosIC1;?></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbCadastroContatosIC1;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroContatosIc2'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc2']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC2;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC2;?></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbCadastroContatosIC2;?></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbCadastroContatosIC2;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroContatosIc3'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc3']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC3;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC3;?></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbCadastroContatosIC3;?></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbCadastroContatosIC3;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
    
                <?php if($GLOBALS['habilitarCadastroContatosIc4'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc4']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC4;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC4;?></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbCadastroContatosIC4;?></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbCadastroContatosIC4;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroContatosIc5'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc5']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC5;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC5;?></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbCadastroContatosIC5;?></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbCadastroContatosIC5;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroContatosIc6'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc6']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc6'] == 1){ ?>
                                <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC6;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc6'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC6;?></textarea>
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
                                    <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbCadastroContatosIC6;?></textarea>
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
                                    <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbCadastroContatosIC6;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroContatosIc7'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc7']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc7'] == 1){ ?>
                                <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC7;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc2'] == 7){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC7;?></textarea>
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
                                    <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbCadastroContatosIC7;?></textarea>
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
                                    <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbCadastroContatosIC7;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroContatosIc8'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc8']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc8'] == 1){ ?>
                                <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC8;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc8'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC8;?></textarea>
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
                                    <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbCadastroContatosIC8;?></textarea>
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
                                    <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbCadastroContatosIC8;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroContatosIc9'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc9']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc9'] == 1){ ?>
                                <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC9;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc9'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC9;?></textarea>
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
                                    <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbCadastroContatosIC9;?></textarea>
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
                                    <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbCadastroContatosIC9;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroContatosIc10'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc10']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc10'] == 1){ ?>
                                <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC10;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc10'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC10;?></textarea>
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
                                    <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbCadastroContatosIC10;?></textarea>
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
                                    <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbCadastroContatosIC10;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroContatosIc11'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc11']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc11'] == 1){ ?>
                                <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255"  value="<?php echo $tbCadastroContatosIC11;?>"/>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc11'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC11;?></textarea>
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
                                    <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbCadastroContatosIC11;?></textarea>
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
                                    <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbCadastroContatosIC11;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarCadastroContatosIc12'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc12']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc12'] == 1){ ?>
                                <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC12;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc12'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC12;?></textarea>
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
                                    <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbCadastroContatosIC12;?></textarea>
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
                                    <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbCadastroContatosIC12;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroContatosIc13'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc13']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc13'] == 1){ ?>
                                <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC13;?>">
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc13'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC13;?></textarea>
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
                                    <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbCadastroContatosIC13;?></textarea>
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
                                    <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbCadastroContatosIC13;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
    
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroContatosIc14'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc14']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc14'] == 1){ ?>
                                <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC14;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc14'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC14;?></textarea>
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
                                    <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbCadastroContatosIC14;?></textarea>
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
                                    <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbCadastroContatosIC14;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarCadastroContatosIc15'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configTituloCadastroContatosIc15']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc15'] == 1){ ?>
                                <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbCadastroContatosIC15;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc15'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosIC15;?></textarea>
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
                                    <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbCadastroContatosIC15;?></textarea>
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
                                    <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbCadastroContatosIC15;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosOBS"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"><?php echo $tbCadastroContatosOBS; ?></textarea>
                        </div>
                    </td>
                </tr>
                
                <?php if($GLOBALS['habilitarCadastroContatosAtivacao'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbCadastroContatosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbCadastroContatosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>

            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbCadastroContatos" type="hidden" id="idTbHistorico" value="<?php echo $idTbCadastroContatos; ?>" />
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbCadastroContatosIdTbCadastro; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
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
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlCadastroContatosSelect);
unset($statementCadastroContatosSelect);
unset($resultadoCadastroContatos);
unset($linhaCadastroContatos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>