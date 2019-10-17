<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $pageSite->cphTitle; ?></title>
    
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
    
    <meta name="Author" content="<?php echo htmlentities($GLOBALS['configNomeDesenvolvedor']); ?>" />
    <meta name="Designer" content="<?php echo htmlentities($GLOBALS['configNomeDesenvolvedor']); ?>" />
    <meta name="copyright" content="<?php echo htmlentities($GLOBALS['configAnoCopiright']); ?>, <?php echo htmlentities($GLOBALS['configNomeCliente']); ?>" />
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
        Ã‚Â» index,follow 
        Esta opÃƒÂ§ÃƒÂ£o faz com que a pÃƒÂ¡gina que contenha esta meta tag e as urls referenciadas nelas, sejam indexadas pelos buscadores. 
        Ã‚Â» noindex,follow 
        Com esta, vocÃƒÂª indexa, somente, as urls referenciadas na pÃƒÂ¡gina, nÃƒÂ£o indexando ela prÃƒÂ³pria. 
        Ã‚Â» index,nofollow 
        O contrÃƒÂ¡rio da anterior. Somente a pÃƒÂ¡gina que contÃƒÂ©m esta meta tag serÃƒÂ¡ indexada, fazendo com que as urls referenciadas nela nÃƒÂ£o sejam indexadas. 
        Ã‚Â» noindex,nofollow 
        NÃƒÂ£o indexa nenhuma das pÃƒÂ¡ginas, nem as urls referenciadas e nem ela prÃƒÂ³pria. (*) 
        Ã‚Â» noarchive 
        Esta opÃƒÂ§ÃƒÂ£o faz com que os buscadores nÃƒÂ£o armazenem uma cÃƒÂ³pia do seu site em cache. Sua utilizaÃƒÂ§ÃƒÂ£o requer um pouco de cuidado, pois uma vantagem em nÃƒÂ£o utilizÃƒÂ¡-la, ÃƒÂ© que caso seu site fique fora do ar por algum problema, ele ainda continuarÃƒÂ¡ sendo indexado, mas caso escolha utilizÃƒÂ¡-la, automaticamente ÃƒÂ© retirado. Vemos isso vÃƒÂ¡rias vezes no Google, por exemplo, que pÃƒÂ¡ginas continuam indexadas e quando clicamos, dÃƒÂ¡ o famoso erro 404. 
		*/
    ?>
    <meta name="Language" content="portuguese" />

    <?php
		/*
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		*/
    ?>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <?php
		/*
        pt-br: PortuguÃƒÂªs do Brasil; 
        en: InglÃƒÂªs 
        es: Espanhol 
        <meta http-equiv="content-language" content="pt-br, en-US, fr" />
		*/
    ?>
    <meta http-equiv="content-language" content="pt-br" />
    <meta http-equiv="pragma" content="no-cache" />
    
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="EstilosLayout.css" rel="stylesheet" type="text/css" />
    <link href="EstilosSite.css" rel="stylesheet" type="text/css" />
    <link href="EstilosImpressao.css" rel="stylesheet" type="text/css" media="print" />

	<?php //Arquivos para a biblioteca JS e JQuery. ?>
	<?php require_once "IncludeJavaScriptHead.php"; ?>
    
    <style type="text/css">

	</style>
</head>
<body style="margin: 0px;">

        <div style="display: none;">
        <?php //ConteÃƒÂºdo - inÃƒÂ­cio.?>
            <?php echo $pageSite->cphTituloLinkAtual; ?>
        <?php //ConteÃƒÂºdo - fim.?>
        </div>
        
        
		<?php //ConteÃƒÂºdo - inÃƒÂ­cio.?>
            <?php echo $pageSite->cphConteudoPrincipal; ?>
        <?php //ConteÃƒÂºdo - fim.?>

</body>
</html>