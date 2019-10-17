<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbPublicacoes = $_GET["idTbPublicacoes"];
$idParentPublicacoes = DbFuncoes::GetCampoGenerico01($idTbPublicacoes, "tb_publicacoes", "id_tb_categorias");

$paginaRetorno = "PublicacoesIndice.php";
$paginaRetornoExclusao = "PublicacoesEditar.php";
$variavelRetorno = "idTbPublicacoes";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentPublicacoes=" . $idParentPublicacoes . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlPublicacoesDetalhesSelect = "";
$strSqlPublicacoesDetalhesSelect .= "SELECT ";
//$strSqlPublicacoesDetalhesSelect .= "* ";
$strSqlPublicacoesDetalhesSelect .= "id, ";
$strSqlPublicacoesDetalhesSelect .= "tipo_publicacao, ";
$strSqlPublicacoesDetalhesSelect .= "id_tb_categorias, ";
$strSqlPublicacoesDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlPublicacoesDetalhesSelect .= "data_publicacao, ";
$strSqlPublicacoesDetalhesSelect .= "data_final_publicacao, ";
$strSqlPublicacoesDetalhesSelect .= "n_classificacao, ";
$strSqlPublicacoesDetalhesSelect .= "titulo, ";
$strSqlPublicacoesDetalhesSelect .= "conteudo_simples, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar1, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar2, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar3, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar4, ";
$strSqlPublicacoesDetalhesSelect .= "informacao_complementar5, ";
$strSqlPublicacoesDetalhesSelect .= "fonte, ";
$strSqlPublicacoesDetalhesSelect .= "link_fonte, ";
$strSqlPublicacoesDetalhesSelect .= "editoria, ";
$strSqlPublicacoesDetalhesSelect .= "palavras_chave, ";
$strSqlPublicacoesDetalhesSelect .= "ativacao, ";
$strSqlPublicacoesDetalhesSelect .= "ativacao_home, ";
$strSqlPublicacoesDetalhesSelect .= "ativacao_home_categoria, ";
$strSqlPublicacoesDetalhesSelect .= "acesso_restrito, ";
$strSqlPublicacoesDetalhesSelect .= "imagem ";
$strSqlPublicacoesDetalhesSelect .= "FROM tb_publicacoes ";
$strSqlPublicacoesDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlPublicacoesDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlPublicacoesDetalhesSelect .= "AND id = :id ";
//$strSqlPublicacoesDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementPublicacoesDetalhesSelect = $dbSistemaConPDO->prepare($strSqlPublicacoesDetalhesSelect);

if ($statementPublicacoesDetalhesSelect !== false)
{
	$statementPublicacoesDetalhesSelect->execute(array(
		"id" => $idTbPublicacoes
	));
}

//$resultadoPublicacoesDetalhes = $dbSistemaConPDO->query($strSqlPublicacoesDetalhesSelect);
$resultadoPublicacoesDetalhes = $statementPublicacoesDetalhesSelect->fetchAll();

if (empty($resultadoPublicacoesDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoPublicacoesDetalhes as $linhaPublicacoesDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbPublicacoesId = $linhaPublicacoesDetalhes['id'];
		$tbPublicacoesTipoPublicacao = $linhaPublicacoesDetalhes['tipo_publicacao'];
		$tbPublicacoesIdTbCategorias = $linhaPublicacoesDetalhes['id_tb_categorias'];
		$tbPublicacoesIdTbCadastroUsuario = $linhaPublicacoesDetalhes['id_tb_cadastro_usuario'];
		$tbPublicacoesDataPublicacao = Funcoes::DataLeitura01($linhaPublicacoesDetalhes['data_publicacao'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbPublicacoesDataFinalPublicacao = Funcoes::DataLeitura01($linhaPublicacoesDetalhes['data_final_publicacao'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbPublicacoesNClassificacao = $linhaPublicacoesDetalhes['n_classificacao'];

		$tbPublicacoesTitulo = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['titulo']);
		$tbPublicacoesConteudoSimples = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['conteudo_simples']);

		$tbPublicacoesIC1 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar1']);
		$tbPublicacoesIC2 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar2']);
		$tbPublicacoesIC3 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar3']);
		$tbPublicacoesIC4 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar4']);
		$tbPublicacoesIC5 = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['informacao_complementar5']);
		
		$tbPublicacoesFonte = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['fonte']);
		$tbPublicacoesLinkFonte = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['link_fonte']);
		$tbPublicacoesEditoria = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['editoria']);
		$tbPublicacoesPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaPublicacoesDetalhes['palavras_chave']);
		
		$tbPublicacoesAtivacao = $linhaPublicacoesDetalhes['ativacao'];
		$tbPublicacoesAtivacaoHome = $linhaPublicacoesDetalhes['ativacao_home'];
		$tbPublicacoesAtivacaoHomeCategoria = $linhaPublicacoesDetalhes['ativacao_home_categoria'];
		$tbPublicacoesAcessoRestrito = $linhaPublicacoesDetalhes['acesso_restrito'];
		
		$tbPublicacoesImagem = $linhaPublicacoesDetalhes['imagem'];
		//Verificação de erro.
		//echo "tbPublicacoesId=" . $tbPublicacoesId . "<br>";
		//echo "tbPublicacoesProcesso=" . $tbPublicacoesProcesso . "<br>";
		
	}
}
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
<?php ob_start(); /*cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesTituloEditar"); ?> - <?php echo DbFuncoes::GetCampoGenerico01($idTbPublicacoes, "tb_publicacoes", "titulo"); ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParentPublicacoes, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
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

    <form name="formPublicacoesEditar" id="formPublicacoesEditar" action="PublicacoesEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesTbPublicacoesEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesData"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<script type="text/javascript">
                            //Variável para conter todos os campos que funcionam com o DatePicker.
                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                            var strDatapickerAgendaPtCampos = "";
                        </script>
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_publicacao;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_publicacao;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_publicacao" id="data_publicacao" class="CampoData01" maxlength="10" value="<?php echo $tbPublicacoesDataPublicacao; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['ativacaoPublicacoesDataFinal'] == 2){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesDataFinal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<script type="text/javascript">
                            //Variável para conter todos os campos que funcionam com o DatePicker.
                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                            var strDatapickerAgendaPtCampos = "";
                        </script>
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_final_publicacao;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_final_publicacao;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_final_publicacao" id="data_final_publicacao" class="CampoData01" maxlength="10" value="<?php echo $tbPublicacoesDataFinalPublicacao; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoes"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarPublicacoesNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="titulo" id="titulo" class="CampoTexto01" maxlength="255" value="<?php echo $tbPublicacoesTitulo; ?>" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarPublicacoesNClassificacao'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbPublicacoesNClassificacao; ?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <?php if($GLOBALS['habilitarPublicacoesConteudoSimples'] == 2){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesConteudoSimples"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="conteudo_simples" id="conteudo_simples" class="CampoTextoMultilinha01"><?php echo $tbPublicacoesConteudoSimples; ?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#conteudo_simples").cleditor(
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
                            <textarea name="conteudo_simples" id="conteudo_simples"><?php echo $tbPublicacoesConteudoSimples; ?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#conteudo_simples").cleditor(
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
                            <textarea name="conteudo_simples" id="conteudo_simples"><?php echo $tbPublicacoesConteudoSimples; ?></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPublicacoesIc1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" value="<?php echo $tbPublicacoesIC1; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"><?php echo $tbPublicacoesIC1; ?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbPublicacoesIC1; ?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbPublicacoesIC1; ?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPublicacoesIc2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" value="<?php echo $tbPublicacoesIC2; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"><?php echo $tbPublicacoesIC2; ?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbPublicacoesIC2; ?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbPublicacoesIC2; ?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPublicacoesIc3'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" value="<?php echo $tbPublicacoesIC3; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"><?php echo $tbPublicacoesIC3; ?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbPublicacoesIC3; ?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbPublicacoesIC3; ?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPublicacoesIc4'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" value="<?php echo $tbPublicacoesIC4; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"><?php echo $tbPublicacoesIC4; ?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbPublicacoesIC4; ?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbPublicacoesIC4; ?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPublicacoesIc5'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPublicacoesTituloIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPublicacoesBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" value="<?php echo $tbPublicacoesIC5; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPublicacoesBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"><?php echo $tbPublicacoesIC5; ?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbPublicacoesIC5; ?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbPublicacoesIC5; ?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['ativacaoPublicacoesFonte'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesFonte"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<input type="text" name="fonte" id="fonte" class="CampoTexto01" maxlength="255" value="<?php echo $tbPublicacoesFonte; ?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['ativacaoPublicacoesFonteLink'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesFonteLink"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<input type="text" name="link_fonte" id="link_fonte" class="CampoTexto01" maxlength="255" value="<?php echo $tbPublicacoesLinkFonte; ?>" />
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['ativacaoPublicacoesEditoria'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPublicacoesEditoria"); ?>:
                    </div>
                </td>

                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<input type="text" name="editoria" id="editoria" class="CampoTexto01" maxlength="255" value="<?php echo $tbPublicacoesEditoria; ?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPublicacoesPalavrasChave'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="CampoTextoMultilinha01"><?php echo $tbPublicacoesPalavrasChave; ?></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave02"); ?>
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
                            <option value="0"<?php if($tbPublicacoesAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbPublicacoesAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
                        
			<?php if($GLOBALS['ativacaoPublicacoesImagens'] == 1){ ?>
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
                            
                            <?php if(!empty($tbPaginasImagem)){ //if($tbCategoriasImagem <> ""){?>
                            <td width="1">
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbPaginasImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbPaginasImagem; ?>" style="margin-left: 4px;" />
                            </td>
                            <td>
                                <a href="RegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbPaginasId;?>&strTabela=tb_publicacoes&strCampo=imagem<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
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
        </table>
        
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbPublicacoes" type="hidden" id="idTbPublicacoes" value="<?php echo $idTbPublicacoes; ?>" />
                <input name="tipo_publicacao" type="hidden" id="tipo_publicacao" value="<?php echo $tbPublicacoesTipoPublicacao; ?>" />
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbPublicacoesIdTbCategorias; ?>" />
                <input name="ativacao_home" type="hidden" id="ativacao_home" value="<?php echo $tbPublicacoesAtivacaoHome; ?>" />
                <input name="ativacao_home_categoria" type="hidden" id="ativacao_home_categoria" value="<?php echo $tbPublicacoesAtivacaoHomeCategoria; ?>" />
                <input name="acesso_restrito" type="hidden" id="acesso_restrito" value="<?php echo $tbPublicacoesAcessoRestrito; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParentPublicacoes=<?php echo $idParentPublicacoes; ?>">
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
unset($strSqlPublicacoesDetalhesSelect);
unset($statementPublicacoesDetalhesSelect);
unset($resultadoPublicacoesDetalhes);
unset($linhaPublicacoesDetalhes);
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>