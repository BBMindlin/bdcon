<?php
//Definição de variáveis.
$IdParentProdutos = $includeProdutos_idParentProdutos; //""(vazio) - seleciona todos registros de publicação | 3489 (id_tb_categorias) - somente daquela categoria
$IdTbCadastroUsuario = $includeProdutos_idTbCadastroUsuario;

$ConfigTipoDiagramacao = $includeProdutos_configTipoDiagramacao; //1 - imagem, título e resumo de texto | 2 - tabela completa | 3 - somente títulos | 11 - galeria de imagens
$ConfigProdutosNRegistros = $includeProdutos_configProdutosNRegistros; //""(vazio) - sem limite | 3 (número) - número máximo de registros
$ConfigClassificacaoProdutos = $includeProdutos_configClassificacaoProdutos;
if($ConfigClassificacaoProdutos == ""){
	$ConfigClassificacaoProdutos = $GLOBALS['configClassificacaoProdutos'];
}

$AtivacaoPromocao = $includeProdutos_ativacaoPromocao;
$AtivacaoHome = $includeProdutos_ativacaoHome;
$AtivacaoHomeCategoria = $includeProdutos_ativacaoHomeCategoria;

$paginacaoNumero = "";
$paginacaoTotal = 0;


//Query de pesquisa.
//----------
$strSqlProdutosSelect = "";
$strSqlProdutosSelect .= "SELECT ";
//$strSqlProdutosSelect .= "* ";
$strSqlProdutosSelect .= "id, ";
$strSqlProdutosSelect .= "id_tb_categorias, ";
$strSqlProdutosSelect .= "id_tb_cadastro_usuario, ";
$strSqlProdutosSelect .= "data_produto, ";
$strSqlProdutosSelect .= "cod_produto, ";
$strSqlProdutosSelect .= "n_classificacao, ";
$strSqlProdutosSelect .= "produto, ";
$strSqlProdutosSelect .= "descricao01, ";
$strSqlProdutosSelect .= "descricao02, ";
$strSqlProdutosSelect .= "descricao03, ";
$strSqlProdutosSelect .= "descricao04, ";
$strSqlProdutosSelect .= "descricao05, ";
$strSqlProdutosSelect .= "informacao_complementar1, ";
$strSqlProdutosSelect .= "informacao_complementar2, ";
$strSqlProdutosSelect .= "informacao_complementar3, ";
$strSqlProdutosSelect .= "informacao_complementar4, ";
$strSqlProdutosSelect .= "informacao_complementar5, ";
$strSqlProdutosSelect .= "informacao_complementar6, ";
$strSqlProdutosSelect .= "informacao_complementar7, ";
$strSqlProdutosSelect .= "informacao_complementar8, ";
$strSqlProdutosSelect .= "informacao_complementar9, ";
$strSqlProdutosSelect .= "informacao_complementar10, ";
$strSqlProdutosSelect .= "informacao_complementar11, ";
$strSqlProdutosSelect .= "informacao_complementar12, ";
$strSqlProdutosSelect .= "informacao_complementar13, ";
$strSqlProdutosSelect .= "informacao_complementar14, ";
$strSqlProdutosSelect .= "informacao_complementar15, ";
$strSqlProdutosSelect .= "palavras_chave, ";
$strSqlProdutosSelect .= "valor, ";
$strSqlProdutosSelect .= "valor1, ";
$strSqlProdutosSelect .= "valor2, ";
$strSqlProdutosSelect .= "peso, ";
$strSqlProdutosSelect .= "coeficiente, ";
$strSqlProdutosSelect .= "estoque, ";
$strSqlProdutosSelect .= "ativacao, ";
$strSqlProdutosSelect .= "ativacao_promocao, ";
$strSqlProdutosSelect .= "ativacao_home, ";
$strSqlProdutosSelect .= "ativacao_home_categoria, ";
$strSqlProdutosSelect .= "acesso_restrito, ";
$strSqlProdutosSelect .= "n_questoes_aprovacao, ";
$strSqlProdutosSelect .= "id_tb_produtos_status, ";
$strSqlProdutosSelect .= "imagem, ";
$strSqlProdutosSelect .= "anotacoes_internas, ";
$strSqlProdutosSelect .= "n_visitas ";
$strSqlProdutosSelect .= "FROM tb_produtos ";
$strSqlProdutosSelect .= "WHERE id <> 0 ";
if($IdParentProdutos <> "")
{
	$strSqlProdutosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($AtivacaoPromocao <> "")
{
	$strSqlProdutosSelect .= "AND ativacao_promocao = :ativacao_promocao ";
}
if($AtivacaoHome <> "")
{
	$strSqlProdutosSelect .= "AND ativacao_home = :ativacao_home ";
}
if($AtivacaoHomeCategoria <> "")
{
	$strSqlProdutosSelect .= "AND ativacao_home_categoria = :ativacao_home_categoria ";
}
$strSqlProdutosSelect .= "AND ativacao = 1 ";
//$strSqlProdutosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
$strSqlProdutosSelect .= "ORDER BY " . $ConfigClassificacaoProdutos . " ";
//----------


//Parâmetros.
//----------
$statementProdutosSelect = $dbSistemaConPDO->prepare($strSqlProdutosSelect);

if ($statementProdutosSelect !== false)
{
	if($IdParentProdutos <> "")
	{
		$statementProdutosSelect->bindParam(':id_tb_categorias', $IdParentProdutos, PDO::PARAM_STR);
	}
	if($AtivacaoPromocao <> "")
	{
		$statementProdutosSelect->bindParam(':ativacao_promocao', $AtivacaoPromocao, PDO::PARAM_STR);
	}
	if($AtivacaoHome <> "")
	{
		$statementProdutosSelect->bindParam(':ativacao_home', $AtivacaoHome, PDO::PARAM_STR);
	}
	if($AtivacaoHomeCategoria <> "")
	{
		$statementProdutosSelect->bindParam(':ativacao_home_categoria', $AtivacaoHomeCategoria, PDO::PARAM_STR);
	}
	$statementProdutosSelect->execute();

	/*
	$statementProdutosSelect->execute(array(
		"id_tb_categorias" => $IdParentProdutos
	));
	*/
	
}
//----------

//$resultadoProdutos = $dbSistemaConPDO->query($strSqlProdutosSelect);
$resultadoProdutos = $statementProdutosSelect->fetchAll();
?>


<?php if(!empty($resultadoProdutos)){?>
	<?php //Diagramação 1.?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "1"){ ?>
    	<div style="position: relative; display: block;">
            <?php
            //Loop pelos resultados.
            foreach($resultadoProdutos as $linhaProdutos)
            {
            ?>
                <div class="ProdutosIndiceContainer">
                    <?php //Título.?>
                    <h2 style="/*position: absolute;*/ display:inline; margin: 0px; padding: 0px; font-size: inherit; float: left;">
                        <div class="ProdutosIndiceTituloFundo">
                            <a href="SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id']; ?>" class="ProdutosIndiceTitulo">
                                <?php if($GLOBALS['configProdutosTituloLimiteCaracteres'] == 0){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>
                                <?php }else{ ?>
                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>
                                    <?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto'])), $GLOBALS['configProdutosTituloLimiteCaracteres']);?>
                                    <?php if(strlen(Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto'])), $GLOBALS['configProdutosTituloLimiteCaracteres'])) > $GLOBALS['configProdutosTituloLimiteCaracteres']){ ?>
                                        ...
									<?php } ?>
                                <?php } ?>
                                
                                
                                <?php
                                    //Obs: acertar lógina da função GetCampoGenerico06.
                                    //"&idsTbProdutosComplemento=" & DbFuncoes.GetCampoGenerico06("tb_produtos_relacao_complemento", "id_tb_produtos_complemento", "id_tb_produtos", Eval("id"), tipoRetorno:=2, strCampoComplementar1Referencia:="tipo_complemento", strCampoComplementar1Valor:="2") 
                                    //"&idParentProdutos=" & Eval("id_tb_categorias")
                                ?>
                            </a>
                        </div>
                    </h2>
        
                    <?php //Imagem.?>
                    <?php if(!empty($linhaProdutos['imagem'])){ ?>
                        <div class="ProdutosImagemIndice">
                            <?php //Sem pop-up. ?>
                            <?php //if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <a href="SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id']; ?>">
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaProdutos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" />
                                </a>
                            <?php //} ?>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['configProdutosImagemPlaceholder'] == 1){ ?>
                        <?php if(empty($linhaProdutos['imagem'])){ ?>
                            <div class="ProdutosImagemIndice">
                            	<?php //OBS: fazer função para resgatar a dimensão (w e h).?>
                                <table bgcolor="#ccc" width="<?php echo $GLOBALS['$arrImagemProdutos'][2][1];?>" height="<?php echo $GLOBALS['$arrImagemProdutos'][2][2];?>" border="0" cellspacing="0">
                                  <tr align="center" valign="middle">
                                    <td>
                                        <a href="SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaProdutos['id']; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>icone_imgem01.png" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']); ?>" /></a>
                                        <br />
                                        <br />
                                        <div class="AdmTexto01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemImagemPlaceholder");?>
                                        </div>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarProdutosDescricao01'] == 1){ ?>
                        <div class="ProdutosIndiceConteudo">
                            <?php if($GLOBALS['ConfigProdutosDescricao01LimiteCaracteres'] == 0){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>
                            <?php }else{ ?>
								<?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaProdutos['descricao01'])), $GLOBALS['configProdutosDescricao01LimiteCaracteres']);?>
                                <?php if(strlen(Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaProdutos['descricao01'])), $GLOBALS['configProdutosDescricao01LimiteCaracteres'])) > $GLOBALS['configProdutosDescricao01LimiteCaracteres']){ ?>
                                    ...
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarProdutosValor'] == 1){ ?>
                        <div class="ProdutosIndiceValor">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor");?>: 
                            </strong>
                        
                            <?php if($linhaProdutos['valor'] > 0){ ?>
                                <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                                <?php echo Funcoes::mascaraValorLer($linhaProdutos['valor']);?>
                            <?php }else{ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor0");?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    
                    <?php //Informações complementares.?>
                    <div class="ProdutosIndiceConteudo">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData");?>: 
                        <?php echo Funcoes::DataLeitura01($linhaProdutos['data_produto'], $GLOBALS['configSiteFormatoData'], "1");?>
                        
                        <?php if($GLOBALS['habilitarProdutosIc1'] == 1){ ?>
                            <?php if($linhaProdutos['informacao_complementar1'] <> ""){ ?>
                                <strong>
                                    <?php echo htmlentities($GLOBALS['configProdutosTituloIc1']);?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['informacao_complementar1']);?>
                                <br />
                            <?php } ?>
                        <?php } ?>
                    </div>
        
                    <?php //Tabelas.?>
                    <?php if($GLOBALS['habilitarProdutosTipo'] == 1){ ?>
                        <div align="left" class="ProdutosIndiceConteudo">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo");?>: 
                            </strong>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarProdutosStatus'] == 1){ ?>
                        <div align="left" class="ProdutosIndiceConteudo">
                            <?php if($linhaProdutos['id_tb_produtos_status'] <> 0){ ?>
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosStatus");?>: 
                                </strong>
                                <?php echo DbFuncoes::GetCampoGenerico01($linhaProdutos['id_tb_produtos_status'], "tb_produtos_complemento", "complemento");?>
                                <br />
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <div class="ProdutosSeparador1">
        
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
<?php } ?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlProdutosSelect);
unset($statementProdutosSelect);
unset($resultadoProdutos);
unset($linhaProdutos);
//----------
?>
