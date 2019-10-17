<?php
//Definição de variáveis.
$IdTbCadastro = $includeCadastro_idTbCadastro; //""(vazio) - seleciona todos registros do cadastro | 3489 (id_tb_categorias) - somente daquela categoria
$IdsTbCadastro = $includeCadastro_idsTbCadastro;
$IdTbCadastroUsuario = $includeCadastro_idTbCadastroUsuario;

$ConfigTipoDiagramacao = $includeCadastro_configTipoDiagramacao; //1 - imagem, título e resumo de texto | 3 - somente títulos | 43 - slider (auto)
$ConfigCadastroNRegistros = $includeCadastro_configCadastroNRegistros; //""(vazio) - sem limite | 3 (número) - número máximo de registros
$ConfigClassificacaoCadastro = $includeCadastro_configClassificacaoCadastro;

$HabilitarCadastroMensagemEnvio = $includeCadastro_habilitarCadastroMensagemEnvio; //1 - envio de mensagem simplificado
$HabilitarCadastroSelecaoItensEnvio = $includeCadastro_habilitarCadastroSelecaoItensEnvio; //1 - envio de mensagem simplificado

$idItemEnviar = "";
$tipoCategoriaEnviar = "";

$Ativacao1 = $includeCadastro_ativacao1;
$Ativacao2 = $includeCadastro_ativacao2;
$Ativacao3 = $includeCadastro_ativacao3;
$Ativacao4 = $includeCadastro_ativacao4;
$AtivacaoDestaque = $includeCadastro_ativacaoDestaque;
$DataNascimento = $includeCadastro_dataNascimento;

$paginacaoNumero = "";
$paginacaoTotal = 0;


//Paginação.
if($GLOBALS['habilitarCadastroSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configCadastroSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}


//Query de pesquisa.
//----------
$strSqlCadastroSelect = "";
$strSqlCadastroSelect .= "SELECT ";
$strSqlCadastroSelect .= "id, ";
$strSqlCadastroSelect .= "id_tb_categorias, ";
//$strSqlCadastroSelect .= "id_parent_cadastro, ";
$strSqlCadastroSelect .= "data_cadastro, ";
$strSqlCadastroSelect .= "pf_pj, ";
$strSqlCadastroSelect .= "nome, ";
$strSqlCadastroSelect .= "sexo, ";
$strSqlCadastroSelect .= "altura, ";
$strSqlCadastroSelect .= "peso, ";
$strSqlCadastroSelect .= "razao_social, ";
$strSqlCadastroSelect .= "nome_fantasia, ";
$strSqlCadastroSelect .= "data_nascimento, ";
$strSqlCadastroSelect .= "cpf_, ";
$strSqlCadastroSelect .= "rg_, ";
$strSqlCadastroSelect .= "cnpj_, ";
$strSqlCadastroSelect .= "documento, ";
$strSqlCadastroSelect .= "i_municipal, ";
$strSqlCadastroSelect .= "i_estadual, ";

$strSqlCadastroSelect .= "endereco_principal, ";
$strSqlCadastroSelect .= "endereco_numero_principal, ";
$strSqlCadastroSelect .= "endereco_complemento_principal, ";
$strSqlCadastroSelect .= "bairro_principal, ";
$strSqlCadastroSelect .= "cidade_principal, ";
$strSqlCadastroSelect .= "estado_principal, ";
$strSqlCadastroSelect .= "pais_principal, ";
$strSqlCadastroSelect .= "cep_principal, ";

$strSqlCadastroSelect .= "ponto_referencia, ";
$strSqlCadastroSelect .= "email_principal, ";
$strSqlCadastroSelect .= "tel_ddd_principal, ";
$strSqlCadastroSelect .= "tel_principal, ";
$strSqlCadastroSelect .= "cel_ddd_principal, ";
$strSqlCadastroSelect .= "cel_principal, ";
$strSqlCadastroSelect .= "fax_ddd_principal, ";
$strSqlCadastroSelect .= "fax_principal, ";
$strSqlCadastroSelect .= "site_principal, ";
$strSqlCadastroSelect .= "n_funcionarios, ";
$strSqlCadastroSelect .= "obs_interno, ";
$strSqlCadastroSelect .= "id_tb_cadastro_status, ";
//$strSqlCadastroSelect .= "id_tb_cadastro, ";
$strSqlCadastroSelect .= "id_tb_cadastro1, ";
$strSqlCadastroSelect .= "id_tb_cadastro2, ";
$strSqlCadastroSelect .= "id_tb_cadastro3, ";

$strSqlCadastroSelect .= "ativacao, ";
$strSqlCadastroSelect .= "ativacao1, ";
$strSqlCadastroSelect .= "ativacao2, ";
$strSqlCadastroSelect .= "ativacao3, ";
$strSqlCadastroSelect .= "ativacao4, ";
$strSqlCadastroSelect .= "ativacao_destaque, ";
$strSqlCadastroSelect .= "ativacao_mala_direta, ";

$strSqlCadastroSelect .= "usuario, ";
$strSqlCadastroSelect .= "senha, ";

$strSqlCadastroSelect .= "imagem, ";
$strSqlCadastroSelect .= "logo, ";
$strSqlCadastroSelect .= "banner, ";
$strSqlCadastroSelect .= "mapa, ";

$strSqlCadastroSelect .= "mapa_online, ";
$strSqlCadastroSelect .= "palavras_chave, ";
$strSqlCadastroSelect .= "apresentacao, ";
$strSqlCadastroSelect .= "servicos, ";
$strSqlCadastroSelect .= "promocoes, ";
$strSqlCadastroSelect .= "condicoes_comerciais, ";
$strSqlCadastroSelect .= "formas_pagamento, ";
$strSqlCadastroSelect .= "horario_atendimento, ";
$strSqlCadastroSelect .= "situacao_atual, ";

$strSqlCadastroSelect .= "informacao_complementar1, ";
$strSqlCadastroSelect .= "informacao_complementar2, ";
$strSqlCadastroSelect .= "informacao_complementar3, ";
$strSqlCadastroSelect .= "informacao_complementar4, ";
$strSqlCadastroSelect .= "informacao_complementar5, ";
$strSqlCadastroSelect .= "informacao_complementar6, ";
$strSqlCadastroSelect .= "informacao_complementar7, ";
$strSqlCadastroSelect .= "informacao_complementar8, ";
$strSqlCadastroSelect .= "informacao_complementar9, ";
$strSqlCadastroSelect .= "informacao_complementar10, ";
$strSqlCadastroSelect .= "informacao_complementar11, ";
$strSqlCadastroSelect .= "informacao_complementar12, ";
$strSqlCadastroSelect .= "informacao_complementar13, ";
$strSqlCadastroSelect .= "informacao_complementar14, ";
$strSqlCadastroSelect .= "informacao_complementar15, ";
$strSqlCadastroSelect .= "informacao_complementar16, ";
$strSqlCadastroSelect .= "informacao_complementar17, ";
$strSqlCadastroSelect .= "informacao_complementar18, ";
$strSqlCadastroSelect .= "informacao_complementar19, ";
$strSqlCadastroSelect .= "informacao_complementar20, ";
$strSqlCadastroSelect .= "informacao_complementar21, ";
$strSqlCadastroSelect .= "informacao_complementar22, ";
$strSqlCadastroSelect .= "informacao_complementar23, ";
$strSqlCadastroSelect .= "informacao_complementar24, ";
$strSqlCadastroSelect .= "informacao_complementar25, ";
$strSqlCadastroSelect .= "informacao_complementar26, ";
$strSqlCadastroSelect .= "informacao_complementar27, ";
$strSqlCadastroSelect .= "informacao_complementar28, ";
$strSqlCadastroSelect .= "informacao_complementar29, ";
$strSqlCadastroSelect .= "informacao_complementar30, ";
$strSqlCadastroSelect .= "informacao_complementar31, ";
$strSqlCadastroSelect .= "informacao_complementar32, ";
$strSqlCadastroSelect .= "informacao_complementar33, ";
$strSqlCadastroSelect .= "informacao_complementar34, ";
$strSqlCadastroSelect .= "informacao_complementar35, ";
$strSqlCadastroSelect .= "informacao_complementar36, ";
$strSqlCadastroSelect .= "informacao_complementar37, ";
$strSqlCadastroSelect .= "informacao_complementar38, ";
$strSqlCadastroSelect .= "informacao_complementar39, ";
$strSqlCadastroSelect .= "informacao_complementar40, ";
$strSqlCadastroSelect .= "n_visitas ";

//Paginação (subquery).
if($GLOBALS['habilitarCadastroSitePaginacao'] == "1"){
	//$strSqlCadastroSelect .= ",(SELECT COUNT(*) ";
	$strSqlCadastroSelect .= ", (SELECT COUNT(id) ";
	$strSqlCadastroSelect .= "FROM tb_cadastro ";
	$strSqlCadastroSelect .= "WHERE id <> 0 ";
	if($IdTbCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($IdsTbCadastro <> "")
	{
		$strSqlCadastroSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($IdsTbCadastro) . ") ";
	}
	if($Ativacao1 <> "")
	{
		$strSqlCadastroSelect .= "AND ativacao1 = :ativacao1 ";
	}
	if($Ativacao2 <> "")
	{
		$strSqlCadastroSelect .= "AND ativacao2 = :ativacao2 ";
	}
	if($Ativacao3 <> "")
	{
		$strSqlCadastroSelect .= "AND ativacao3 = :ativacao3 ";
	}
	if($Ativacao4 <> "")
	{
		$strSqlCadastroSelect .= "AND ativacao4 = :ativacao4 ";
	}
	if($AtivacaoDestaque <> "")
	{
		$strSqlCadastroSelect .= "AND ativacao_destaque = :ativacao_destaque ";
	}
	$strSqlCadastroSelect .= ") totalRegistros ";
}

$strSqlCadastroSelect .= "FROM tb_cadastro ";
$strSqlCadastroSelect .= "WHERE id <> 0 ";
$strSqlCadastroSelect .= "AND ativacao = 1 ";
//$strSqlCadastroSelect .= "AND ativacao_destaque = 1 ";
if($IdTbCadastro <> "")
{
	$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($IdsTbCadastro <> "")
{
	$strSqlCadastroSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($IdsTbCadastro) . ") ";
}
if($Ativacao1 <> "")
{
	$strSqlCadastroSelect .= "AND ativacao1 = :ativacao1 ";
}
if($Ativacao2 <> "")
{
	$strSqlCadastroSelect .= "AND ativacao2 = :ativacao2 ";
}
if($Ativacao3 <> "")
{
	$strSqlCadastroSelect .= "AND ativacao3 = :ativacao3 ";
}
if($Ativacao4 <> "")
{
	$strSqlCadastroSelect .= "AND ativacao4 = :ativacao4 ";
}
if($AtivacaoDestaque <> "")
{
	$strSqlCadastroSelect .= "AND ativacao_destaque = :ativacao_destaque ";
}

$strSqlCadastroSelect .= "ORDER BY " . $ConfigClassificacaoCadastro . " ";

//Paginação.
/*
if($GLOBALS['habilitarCadastroSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlCadastroSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . " ";
	}
}
*/

if($ConfigCadastroNRegistros <> "")
{
	if($configTipoDB == 2)
	{
		//$strSqlCadastroSelect .= "TOP " . Funcoes::ConteudoMascaraGravacao01($ConfigCadastroNRegistros) . " ";
		//$strSqlCadastroSelect .= "LIMIT " . "0" . ", " . Funcoes::ConteudoMascaraGravacao01($ConfigCadastroNRegistros) . " "; //funcionando
		$strSqlCadastroSelect .= "LIMIT " . Funcoes::ConteudoMascaraGravacao01($ConfigCadastroNRegistros) . " ";
	}
}else{
	//Paginação.
	if($GLOBALS['habilitarCadastroSitePaginacao'] == "1"){ 
		if($configTipoDB == 2)
		{
			$strSqlCadastroSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . " ";
		}
	}
}
//echo "strSqlCadastroSelect=" . $strSqlCadastroSelect . "<br/>";
//----------


//Componentes.
//----------
$statementCadastroSelect = $dbSistemaConPDO->prepare($strSqlCadastroSelect);

if ($statementCadastroSelect !== false)
{
	if($IdTbCadastro <> "")
	{
		$statementCadastroSelect->bindParam(':id_tb_categorias', $IdTbCadastro, PDO::PARAM_STR);
	}
	if($Ativacao1 <> "")
	{
		$statementCadastroSelect->bindParam(':ativacao1', $Ativacao1, PDO::PARAM_STR);
	}
	if($Ativacao2 <> "")
	{
		$statementCadastroSelect->bindParam(':ativacao2', $Ativacao2, PDO::PARAM_STR);
	}
	if($Ativacao3 <> "")
	{
		$statementCadastroSelect->bindParam(':ativacao3', $Ativacao3, PDO::PARAM_STR);
	}
	if($Ativacao4 <> "")
	{
		$statementCadastroSelect->bindParam(':ativacao4', $Ativacao4, PDO::PARAM_STR);
	}
	if($AtivacaoDestaque <> "")
	{
		$strSqlCadastroSelect .= "AND ativacao_destaque = :ativacao_destaque ";
	}
	$statementCadastroSelect->execute();
	/*
	$statementCadastroSelect->execute(array(
		"id_tb_categorias" => $idParentCadastro
	));
	*/
}

//$resultadoCadastro = $dbSistemaConPDO->query($strSqlCadastroSelect);
$resultadoCadastro = $statementCadastroSelect->fetchAll();
//----------


//Paginação.
if($GLOBALS['habilitarCadastroSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoCadastro[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}
?>

	<?php //Diagramação 1 (imagem, título e resumo de texto).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "1"){ ?>
	<div style="position: relative; display: block; overflow: hidden;">
		<?php
        if (empty($resultadoCadastro))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmAlerta">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemCadastroVazio"); ?>
            </div>
        <?php
        }else{
        ?>
			<?php
            $countTabelaFundo = 0;
			
			$arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 69);

            
            //Loop pelos resultados.
            foreach($resultadoCadastro as $linhaCadastro)
            {
            //echo "id=" . $linhaCategorias['id'] . "<br />";
            ?>
                <div align="left" class="CadastroIndiceContainer">
                    <?php //Imagem. ?>
                    <?php if($GLOBALS['ativacaoCadastroVisualizacaoImagem'] == 1){ ?>
                        <?php if(!empty($linhaCadastro['imagem'])){ ?>
                            <?php //Link. ?>
                            <a href="SiteCadastroDetalhes.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>">
                                <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>" alt="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>" />
                            </a>
                        
                        	<?php //Div e imagem de fundo. ?>
                        	<div onclick="location.href='SiteCadastroDetalhes.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>';" style="position: relative; display: block; height: 52px; width: 52px; margin-left: 4px; margin-right: 10px; float: left; background-image: url(../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>); background-repeat: no-repeat; background-position: center center; overflow: hidden; cursor: pointer;">
                            	
                        	</div>
                            
                            
                        	<?php //Div com imagem dentro. ?>
                            <div style="position: relative; display: none; height: 52px; width: 52px; margin-left: 4px; margin-right: 10px; float: left; overflow: hidden;">
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>" alt="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaCadastro['imagem'];?>" rel="lightbox" title="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>">
                                        <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaCadastro['imagem'];?>" alt="<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>" />
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    
                    <?php //Informações. ?>
                    <div class="CadastroIndiceConteudo" align="left" style="position: relative; display: block; width: 100%; margin-left: 70px;">
                    	<a href="SiteCadastroDetalhes.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>" class="CadastroIndiceTitulo">
                        	<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), 
							Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), 
							Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>
                        </a>
                        <div>
                        	<?php echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['informacao_complementar1']);?>
                        </div>
                    </div>
                    
                    
                    <?php //Filtros. ?>
                    <div class="CadastroIndiceConteudo" align="left" style="position: relative; display: block;">
                        <div>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>:
                        </div>
						<?php 
                        $arrCadastroFiltroGenerico20Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaCadastro['id'], "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "69", "", ",", "", "1"));
                        
                        ?>
                        <?php 
                        for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrCadastroFiltroGenerico20[$countArray][0], $arrCadastroFiltroGenerico20Selecao)){ ?> 
                                    - <?php echo $arrCadastroFiltroGenerico20[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>                    
                    
                    
                    <?php //Botão detalhes. ?>
                    <a href="SiteCadastroDetalhes.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>" style="position: relative; display: block;">
                        <img src="img/btoDetalhesCadastro.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoDetalhes"); ?>" />
                    </a>
                    
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
	<?php //Diagramação 43 - slider (auto).?>
    <?php //**************************************************************************************?>
    <?php if($ConfigTipoDiagramacao == "43"){ ?>
    <ul id="bxslider<?php echo $IdTbCadastro; ?>" class="bxslider">
		<?php
        if (empty($resultadoCadastro))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmAlerta">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemCadastroVazio"); ?>
            </div>
        <?php
        }else{
        ?>
			<?php
            $countTabelaFundo = 0;
            
            //Loop pelos resultados.
            foreach($resultadoCadastro as $linhaCadastro)
            {
            //echo "id=" . $linhaCategorias['id'] . "<br />";
            ?>
                <li>
                    <a href="SiteCadastroDetalhes.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>" class="CadastroIndiceTitulo">
                        <?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), 
                        Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), 
                        Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 1); ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    
    </ul>
    <script type="text/javascript">
        //infiniteLoop: false,
        //auto: true,
        $('#bxslider<?php echo $IdTbCadastro; ?>').bxSlider({
			mode: 'fade',
			auto: true,
            infiniteLoop: true,
            pager: false,
			controls: false,
            captions: true
        });

        //Scroll de galeria.
        //Obs: Não pode ter o parâmetro mode: 'fade'.
        /*$('#bxslider<%=IdTbArquivos()%>').bxSlider({
            hideControlOnEnd: true,
            infiniteLoop: false,
            pager: false,
            minSlides: 3,
            maxSlides: 3,
            slideWidth: 210,
            slideMargin: 10,
            useCSS: false,
            captions: true
        });*/
    </script>
    <?php } ?>
    <?php //**************************************************************************************?>

<?php
//Limpeza de objetos.
//----------
unset($strSqlCadastroSelect);
unset($statementCadastroSelect);
unset($resultadoCadastro);
unset($linhaCadastro);
//----------
?>