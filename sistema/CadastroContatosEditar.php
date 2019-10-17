<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroContatos = $_GET["idTbCadastroContatos"];
$idTbCadastro = DbFuncoes::GetCampoGenerico01($idTbCadastroContatos, "tb_cadastro_contatos", "id_tb_cadastro");

$paginaRetorno = "CadastroContatosIndice.php";
$paginaRetornoExclusao = "CadastroContatosEditar.php";
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
//----------


//Parâmetros.
//----------
$statementCadastroContatosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCadastroContatosDetalhesSelect);

if ($statementCadastroContatosDetalhesSelect !== false)
{
	$statementCadastroContatosDetalhesSelect->execute(array(
		"id" => $idTbCadastroContatos
	));
}

//$resultadoCadastroContatosDetalhes = $dbSistemaConPDO->query($strSqlCadastroContatosDetalhesSelect);
$resultadoCadastroContatosDetalhes = $statementCadastroContatosDetalhesSelect->fetchAll();
//----------


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
		$tbCadastroContatosOBS = Funcoes::ConteudoMascaraLeitura($linhaCadastroContatosDetalhes['obs']);
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
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?>
     - 
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
     - 
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosEditarTitulo"); ?>
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
        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosEditarTitulo"); ?>
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


    <form name="formCadastroContatosEditar" id="formCadastroContatosEditar" action="CadastroContatosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="TabelaCampos01">
                <tr>
                    <td class="TbFundoEscuro" colspan="4">
                        <div align="center" class="Texto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosTbContatoEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarCadastroContatosFilial'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosFilial"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="filial" id="filial" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosFilial; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosNome"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="nome" id="nome" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosNome; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosDepartamento"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="departamento" id="departamento" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosDepartamento; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosTel"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            (<input type="text" name="tel_ddd" id="tel_ddd" class="CampoDDD01" maxlength="255" value="<?php echo $tbCadastroContatosTelDDD; ?>" />)
                            <input type="text" name="tel" id="tel" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosTel; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosCel"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            (<input type="text" name="cel_ddd" id="cel_ddd" class="CampoDDD01" maxlength="255" value="<?php echo $tbCadastroContatosCelDDD; ?>" />)
                            <input type="text" name="cel" id="cel" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosCel; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosEMail"); ?>
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="email" id="email" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosEMail; ?>" />
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarCadastroContatosIc1'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC1;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC1;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC2;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC2;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC3;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC3;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC4;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC4;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC5;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC5;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc6'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc6'] == 1){ ?>
                                <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC6;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc6'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar6" id="informacao_complementar6" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC6;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc7']); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc7'] == 1){ ?>
                                <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC7;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc7'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar7" id="informacao_complementar7" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC7;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc8'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc8'] == 1){ ?>
                                <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC8;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc8'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar8" id="informacao_complementar8" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC8;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc9'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc9'] == 1){ ?>
                                <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC9;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc9'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar9" id="informacao_complementar9" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC9;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc10'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc10'] == 1){ ?>
                                <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC10;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc10'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar10" id="informacao_complementar10" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC10;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc11'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc11'] == 1){ ?>
                                <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="CampoTexto01" maxlength="255"  value="<?php echo $tbCadastroContatosIC11;?>"/>
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc11'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar11" id="informacao_complementar11" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC11;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc12'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc12'] == 1){ ?>
                                <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC12;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc12'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar12" id="informacao_complementar12" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC12;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc13'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc13'] == 1){ ?>
                                <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC13;?>">
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc13'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar13" id="informacao_complementar13" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC13;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc14'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc14'] == 1){ ?>
                                <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC14;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc14'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar14" id="informacao_complementar14" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC14;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="Texto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroContatosIc15'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configCadastroContatosBoxIc15'] == 1){ ?>
                                <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="CampoTexto01" maxlength="255" value="<?php echo $tbCadastroContatosIC15;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configCadastroContatosBoxIc15'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar15" id="informacao_complementar15" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosIC15;?></textarea>
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
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaContatosOBS"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="CampoTextoMultilinha01"><?php echo $tbCadastroContatosOBS; ?></textarea>
                        </div>
                    </td>
                </tr>
                
                <?php if($GLOBALS['habilitarCadastroContatosAtivacao'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="Texto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                        </div>
                    </td>
                    <td class="TbFundoClaro" colspan="3">
                        <div align="left" class="Texto01">
                            <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbCadastroContatosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbCadastroContatosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>

            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbCadastroContatos" type="hidden" id="idTbCadastroContatos" value="<?php echo $idTbCadastroContatos; ?>" />
                <input name="id_tb_cadastro" type="hidden" id="id_tb_cadastro" value="<?php echo $tbCadastroContatosIdTbCadastro; ?>" />
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
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlCadastroContatosDetalhesSelect);
unset($statementCadastroContatosDetalhesSelect);
unset($resultadoCadastroContatosDetalhes);
unset($linhaCadastroContatosDetalhes);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>