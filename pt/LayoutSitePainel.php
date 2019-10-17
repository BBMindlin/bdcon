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

	<!--Box painel.-->
	<div style="position: absolute; display: block; width: 1014px; height: 668px; margin-top: -334px; margin-left: -507px; top: 50%; left: 50%; /*border: 1px solid #efe4b0; background-color: #ffffff; */">
        
        <!--Box principal.-->
        <div style="position: absolute; display: block; width: 990px; min-height: 365px; top: 15px; left: 12px; border: 1px solid #000000; background-color: #ddd; padding-bottom: 20px;">
        	<!--Títulos.-->
            <?php if($_SERVER['PHP_SELF'] <> "/pt/SiteAdm.php" && $_SERVER['PHP_SELF'] <> "/pt/SiteLogin.php"){ ?>
            <div style="position: absolute; display: block; /*height: 20px; */top: -8px; left: 13px; border: 1px solid #000000; background-color: #ffffff;">
            	<span class="SiteTitulos01" style="position: relative; display: block; padding: 3px 5px 3px 5px;">
                    <?php echo $pageSite->cphTituloLinkAtual; ?>
                </span>
            </div>
            <?php } ?>
            
            <div align="center" style="position: relative; display: block; overflow: hidden; margin: 40px 0px 40px 0px;">
                <a href="SiteLogin.php">
                	<img src="img/logo01.png" alt="BBM" />
                </a>
            </div>
            
            <div style="position: relative; display: block; width: 800px; margin: auto;">
				<?php //ConteÃºdo - inÃ­cio.?>
                    <?php echo $pageSite->cphConteudoPrincipal; ?>
                <?php //ConteÃºdo - fim.?>
            </div>
            
        </div>
    </div>
	<!--Box painel.-->
    
</div>
</body>
</html>