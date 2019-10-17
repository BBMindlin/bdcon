<?php
//Importa��o dos arquivos de configura��o.
require_once "sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "sistema/IncludeConexao.php";
require_once "sistema/IncludeFuncoes.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?></title><?php //Abaixo de 60 caracteres (obs: nome do site no final do t�tulo).?>
    
    <?php //Favicon - 16x16 | 32x32 | 64x64 (pixels).?>
    <link rel="bookmark" href="favicon.ico" />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <link rel="icon" type="image/gif" href="animated_favicon1.gif" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="Shortcut Icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" />
    <meta name="Title" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?>" />

    <meta name="Author" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeDesenvolvedor'], "IncludeConfig"); ?>" />
    <meta name="Designer" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeDesenvolvedor'], "IncludeConfig"); ?>" />
    <meta name="copyright" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configAnoCopiright'], "IncludeConfig"); ?>, <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>" />
    <meta name="rating" content="general" /><?php //general | mature | restricted | 14 years?>
    <!--meta name="expires" content="never" /--><?php //ex: 28 June 2003-?>
    <!--meta name="distribution" content="global" /--><?php //ex: global | local | IU ?>
    <meta name="robots" content="index,follow" />
    <?php
    //index,follow 
    //Esta op��o faz com que a p�gina que contenha esta meta tag e as urls referenciadas nelas, sejam indexadas pelos buscadores. 
    //noindex,follow 
    //Com esta, voc� indexa, somente, as urls referenciadas na p�gina, n�o indexando ela pr�pria. 
    //index,nofollow 
    //O contr�rio da anterior. Somente a p�gina que cont�m esta meta tag ser� indexada, fazendo com que as urls referenciadas nela n�o sejam indexadas. 
    //noindex,nofollow 
    //N�o indexa nenhuma das p�ginas, nem as urls referenciadas e nem ela pr�pria. (*) 
    //noarchive 
    //Esta op��o faz com que os buscadores n�o armazenem uma c�pia do seu site em cache. Sua utiliza��o requer um pouco de cuidado, pois uma vantagem em n�o utiliz�-la, � que caso seu site fique fora do ar por algum problema, ele ainda continuar� sendo indexado, mas caso escolha utiliz�-la, automaticamente � retirado. Vemos isso v�rias vezes no Google, por exemplo, que p�ginas continuam indexadas e quando clicamos, d� o famoso erro 404. 
    ?>
    <meta name="Language" content="portuguese" />
    <!--meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /-->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="pt-br" />

    <?php
    //pt-br: Portugu�s do Brasil; 
    //en: Ingl�s 
    //es: Espanhol 
    //<meta http-equiv="content-language" content="pt-br, en-US, fr" />
    ?>
    <meta http-equiv="pragma" content="no-cache" />
    
    <link href="EstilosRoot.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $GLOBALS['visualizacaoAtivaSistema']; ?>/EstilosSite.css" rel="stylesheet" type="text/css" />
    
    
    <?php include "CodigoAcompanhamento.php";?>
    
    
    <?php //Detec��o de resolu��o. ?>
    <?php //**************************************************************************************?>
    <script type="text/javascript">
        //Cria��o de vari�veis.
        var visitanteResolucaoW = window.screen.width;
        var visitanteResolucaoH = window.screen.height;
        //var versaoSiteNavegacao = "pt";
        var versaoSiteNavegacao = "<?php echo $GLOBALS['visualizacaoAtivaSistema']; ?>";
        
        //Grava��o de cookie da largura da resolu��o.
        //document.cookie = "resolucaoW=" + visitanteResolucaoW;
        //document.cookie = "resolucaoW=" + ""; //Apagar cookie.
    
        //Verifica��o.
        if(visitanteResolucaoW > 800)
        {
            //versaoSiteNavegacao = "<frame src='mobile/index.asp' name='site' frameborder='no' noresize id='site'>";
        }else{
            // similar behavior as an HTTP redirect
            //window.location.replace("http://stackoverflow.com");
            
            // similar behavior as clicking on a link
            //window.location.href = "mobile/index.asp"; //Funcionando.
            
        }
    
        //document.cookie = "visitanteResolucaoW=" + visitanteResolucaoW;
        //document.cookie = "visitanteResolucaoH=" + visitanteResolucaoH;
    
        //alert(visitanteResolucaoH);
    </script>
    <?php //**************************************************************************************?>
    
    
    <?php //Redirecionamento para permitir acesso ao endere�o completo no navegador. ?>
    <?php //**************************************************************************************?>
    <script type="text/javascript">
		//window.location.href = "pt/index.asp";
		//window.location.replace("http://www.dominio.com/pt/index.php");
		//window.location.replace("<?php echo $GLOBALS['configURL']; ?>/<?php echo $GLOBALS['visualizacaoAtivaSistema']; ?>/index.php"); //Funcionando.
    </script>
    <?php //**************************************************************************************?>
</head>
<body>
    <div class="PosIframePrincipal"> 
        <iframe src="<?php echo $GLOBALS['visualizacaoAtivaSistema']; ?>/SiteLogin.php" scrolling="auto" name="site" frameborder="0" align="left" width="100%" height="100%">
        </iframe>
        <?php  
        //Alternativa para acesso direto � p�gina de cadastro (indica��o de cookie tempor�rio e tipo de cadastro).
		//?masterPageSiteSelect=LayoutSitePainel.php 
        ?>
    </div>
</body>
</html>
<?php

//Fechamento da conex�o.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>