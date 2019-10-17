<?php
$tbProdutosId = $idParent;
$idTipoProduto = DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1");
$idTipoProduto_print = DbFuncoes::GetCampoGenerico01($idTipoProduto, "tb_produtos_complemento", "complemento");

$tbProdutosCodProduto = "";
$tbProdutosProduto = "";
$tbProdutosIC1 = "";

//Filtros.
//----------
$resultadoProdutosComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_produtos_complemento", 
								NULL, 
								"complemento", 
								"");
$resultadoProdutosComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_produtos_relacao_complemento", 
																					$tbProdutosId, 
																					"id_tb_produtos");

$tbProdutosFG01 = "";
$tbProdutosFG02 = "";
$tbProdutosFG03 = "";

//Loop pelos resultados.
foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
{
	if($linhaProdutosComplemento["tipo_complemento"] == "12")
	{
		if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento')))
		{
			$tbProdutosFG01 = Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);
		}
	}
	if($linhaProdutosComplemento["tipo_complemento"] == "13")
	{
		if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento')))
		{
			$tbProdutosFG02 = Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);
		}
	}
	if($linhaProdutosComplemento["tipo_complemento"] == "14")
	{
		if(in_array($linhaProdutosComplemento["id"], array_column($resultadoProdutosComplementoRelacao, 'id_tb_produtos_complemento')))
		{
			$tbProdutosFG03 = Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);
		}
	}
} 
//----------


//Objeto - Produtos.
//----------
//Detalhes do produto vinculado.
$opdProdutoVinculado = new ObjetoProdutosDetalhes(); //Criação de objeto com os detalhes do cadastro.
if(DbFuncoes::GetCampoGenerico01($idParent, "tb_produtos", "id") <> "")
{
	//$resultadoCadastroDetalhes = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_cadastro", array("id;" . $idTbCadastroLogado . ";i"));	
	
	//Definição dos valores do cadastro logado.
	$opdProdutoVinculado->ProdutosDetalhesResultado($idParent, 1);
	
	//Definição de valores.
	//$tbProdutosId = $opdProdutoVinculado->tbProdutosId;
	$tbProdutosCodProduto = $opdProdutoVinculado->tbProdutosCodProduto;
	$tbProdutosProduto = $opdProdutoVinculado->tbProdutosProduto;
	$tbProdutosIC1 = $opdProdutoVinculado->tbProdutosIC1;
	
	
	//Verificação de erro - debug.
	//echo "tbProdutosId=" . $opdProdutoVinculado->tbProdutosId . "<br />";
	//echo "tbProdutosProduto=" . $opdProdutoVinculado->tbProdutosProduto . "<br />";
}
/**/
//----------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $pageSite->cphTitle; ?></title>
    
	<?php require_once "../CodigoAcompanhamento.php";?>

    <?php //Favicon - 16x16 | 32x32 | 64x64 (pixels).?>
    <link rel="bookmark" href="../favicon.ico" />
    <link rel="icon" type="image/x-icon" href="../favicon.ico" />
    <link rel="icon" type="image/gif" href="../animated_favicon1.gif" />
    <link rel="icon" type="image/png" href="../favicon.png" />
    <link rel="Shortcut Icon" type="image/vnd.microsoft.icon" href="../favicon.ico" />
    
    <?php echo $pageSite->cphHead; ?>
    	
	<?php
    //<meta http-equiv="cache-control" content="max-age=0" />
    //<meta http-equiv="cache-control" content="no-cache" />
    //<meta http-equiv="expires" content="0" />
    //<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    //<meta http-equiv="pragma" content="no-cache" />
    ?>    
    
    <meta name="Author" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeDesenvolvedor'], "IncludeConfig"); ?>" />
    <meta name="Designer" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeDesenvolvedor'], "IncludeConfig"); ?>" />
    <meta name="copyright" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configAnoCopiright'], "IncludeConfig"); ?>, <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>" />
    <meta name="rating" content="general" /><?php //general | mature | restricted | 14 years?>
    <?php
		/*
        <!--meta name="expires" content="never" /--><!--ex: 28 June 2003-->
        <!--meta name="distribution" content="global" /--><!--ex: global | local | IU -->
		*/
    ?>
    <meta name="robots" content="index,follow" />
    <?php
		/*
        Â» index,follow 
        Esta opÃ§Ã£o faz com que a pÃ¡gina que contenha esta meta tag e as urls referenciadas nelas, sejam indexadas pelos buscadores. 
        Â» noindex,follow 
        Com esta, vocÃª indexa, somente, as urls referenciadas na pÃ¡gina, nÃ£o indexando ela prÃ³pria. 
        Â» index,nofollow 
        O contrÃ¡rio da anterior. Somente a pÃ¡gina que contÃ©m esta meta tag serÃ¡ indexada, fazendo com que as urls referenciadas nela nÃ£o sejam indexadas. 
        Â» noindex,nofollow 
        NÃ£o indexa nenhuma das pÃ¡ginas, nem as urls referenciadas e nem ela prÃ³pria. (*) 
        Â» noarchive 
        Esta opÃ§Ã£o faz com que os buscadores nÃ£o armazenem uma cÃ³pia do seu site em cache. Sua utilizaÃ§Ã£o requer um pouco de cuidado, pois uma vantagem em nÃ£o utilizÃ¡-la, Ã© que caso seu site fique fora do ar por algum problema, ele ainda continuarÃ¡ sendo indexado, mas caso escolha utilizÃ¡-la, automaticamente Ã© retirado. Vemos isso vÃ¡rias vezes no Google, por exemplo, que pÃ¡ginas continuam indexadas e quando clicamos, dÃ¡ o famoso erro 404. 
		*/
    ?>
    <meta name="Language" content="portuguese" />
    <meta http-equiv="content-language" content="pt-br" />
    <meta http-equiv="pragma" content="no-cache" />

    <?php
		/*
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		*/
    ?>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <?php
		/*
        pt-br: PortuguÃªs do Brasil; 
        en: InglÃªs 
        es: Espanhol 
        <meta http-equiv="content-language" content="pt-br, en-US, fr" />
		*/
    ?>
    
    <link href="EstilosLayout.css" rel="stylesheet" type="text/css" />
    <link href="EstilosSite.css?v=3" rel="stylesheet" type="text/css" />

	<?php //Arquivos para a biblioteca JS e JQuery. ?>
	<?php require_once "IncludeJavaScriptHead.php"; ?>
    
    <style type="text/css">
	
    </style>
</head>
<body class="BodyMaster03">
<div id="updtPnlMasterPageSite">


	<!--Box ficha tratamento.-->
	<div style="position: absolute; display: block; width: 1014px; height: 668px; margin-top: -334px; margin-left: -507px; top: 50%; left: 50%; /*border: 1px solid #efe4b0; background-color: #ffffff; */">
        <!--Box principal.-->
        <div style="position: absolute; display: block; width: 990px;height: 630px; top: 30px; left: 12px; border: 1px solid #000000; background-color: #ffffff;">
        	<!--Títulos.-->
            <div style="position: absolute; display: block; min-width: 190px; /*height: 20px; */top: -22px; left: 0px; border: 1px solid #000000; background-color: #ffffff; z-index: 1;">
            	<span class="SiteTitulos01" style="position: relative; display: block; padding: 3px 5px 3px 5px;">
                    <?php echo $idTipoProduto_print; ?> - <?php echo $pageSite->cphTituloLinkAtual; ?>
                </span>
            </div>
            
            <div style="position: absolute; display: none; top: -15px; width: 100%; right: 0px; z-index: 1;">
            	<img src="img/logo02.png" alt="Logo" style="position: absolute; display: block; left: 210px; top: -5px; font-weight: bold;" />
            
            	<span class="SiteTitulos02" style="position: absolute; display: block; right: 0px; font-weight: bold;">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteRazaoSocial'], "IncludeConfig"); ?>
                </span>
            </div>
            
            
            <!--Informações principais.-->
            <div class="AdmTexto01" style="position: absolute; display: block; width: 100%; height: 25px; top: 0px; left: 0px; border-bottom: 1px solid #000000; background-color: #ddd;">
                <div style="position: absolute; display: block; top: 3px; left: 12px;">
                	<strong>
                    	Tombo/Codbar: 
                    </strong>
                    <input type="text" name="info1" value="<?php echo $tbProdutosIC1; ?>" readonly="readonly" style="position: relative; display: inline-block; height: 16px; line-height: 16px; background-color: #fff; border: 1px solid #000; padding: 0px 4px 0px 4px; width: 75px; background-color: #efe4b0; margin-right: 15px;" />
                    
                	<strong>
                    	N ref: 
                    </strong>
                    <input type="text" name="info2" value="<?php echo $tbProdutosCodProduto; ?>" readonly="readonly" style="position: relative; display: inline-block; height: 16px; line-height: 16px; background-color: #fff; border: 1px solid #000; padding: 0px 4px 0px 4px; width: 60px; background-color: #efe4b0; margin-right: 15px;" />
                    
                	<strong>
                    	Autor Principal: 
                    </strong>
                    <input type="text" name="info3" value="<?php echo $tbProdutosFG01; ?> <?php echo $tbProdutosFG02; ?>  <?php echo $tbProdutosFG03; ?>" readonly="readonly" style="position: relative; display: inline-block; height: 16px; line-height: 16px; background-color: #fff; border: 1px solid #000; padding: 0px 4px 0px 4px; width: 200px; background-color: #efe4b0; margin-right: 15px;" />
                    
                	<strong>
                    	Titulo: 
                    </strong>
                    <input type="text" name="info4" value="<?php echo $tbProdutosProduto; ?>" readonly="readonly" style="position: relative; display: inline-block; height: 16px; line-height: 16px; background-color: #fff; border: 1px solid #000; padding: 0px 4px 0px 4px; width: 225px; background-color: #efe4b0;" />
                </div>
            </div>
            <!--Informações principais.-->

            
            <!--Janela principal.-->
            <div style="position: absolute; display: block; width: 970px; height: 550px; top: 50px; left: 10px;">
				<?php echo $pageSite->cphConteudoPrincipal; ?>
            </div>
            <!--Janela principal.-->
        </div>
    </div>
	<!--Box ficha tratamento.-->

</div>
</body>
</html>