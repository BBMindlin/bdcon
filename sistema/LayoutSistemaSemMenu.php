<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $page->cphTitle; ?></title>
    
    <?php //Favicon - 16x16 | 32x32 | 64x64 (pixels).?>
    <link rel="bookmark" href="../favicon.ico" />
    <link rel="icon" type="image/x-icon" href="../favicon.ico" />
    <link rel="icon" type="image/gif" href="../animated_favicon1.gif" />
    <link rel="icon" type="image/png" href="../favicon.png" />
    <link rel="Shortcut Icon" type="image/vnd.microsoft.icon" href="../favicon.ico" />
    
    <?php echo $page->cphHead; ?>
    	
	<?php
    //<meta http-equiv="cache-control" content="max-age=0" />
    //<meta http-equiv="cache-control" content="no-cache" />
    //<meta http-equiv="expires" content="0" />
    //<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    //<meta http-equiv="pragma" content="no-cache" />
    ?>    
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="EstilosSistemaLayout.css" rel="stylesheet" type="text/css" />
    <link href="EstilosSistema.css" rel="stylesheet" type="text/css" />


    <?php //Arquivos para a bilioteca de funções personalizadas.?>
    <script src="../js/include-funcoes.js" type="text/javascript"></script>


	<?php //Arquivos para a biblioteca JQuery.?>
	<?php //**************************************************************************************?>
	<!--script type="text/javascript" src="../jquery/datepicker/js/jquery-1.8.2.min.js"></script-->
	<script type="text/javascript" src="../jquery/jquery-1.8.3.js"></script>
	<!--script type="text/javascript" src="../jquery/jquery-2.1.3.min.js"></script--><!--Obs: dando problema com slimbox2.-->
	<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"> </script--><!--Carregador do servidor (Google). -->
	<!--script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"> </script--><!--Carregador do servidor (Microsoft). -->
	<?php //**************************************************************************************?>
    
    
	<?php //Arquivos para User Interface JQuery.?>
	<?php //**************************************************************************************?>
	<?php 
	//http://jqueryui.com/download
	?>
	<!--link type="text/css" href="../jquery/datepicker/css/redmond/jquery-ui-1.8.24.custom.css" rel="stylesheet" /--> <!--Theme: redmond.-->
	<!--link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"-->
	<!--link rel="stylesheet" href="../jquery/ui/1.10.4/themes/smoothness/jquery-ui-1.10.4.custom.css"--> <!--Theme: smoothness.-->
	<link rel="stylesheet" href="../jquery/ui/1.11.2/themes/smoothness/jquery-ui.css" /> <!--Theme: smoothness.-->

	<!--script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script-->
	<script type="text/javascript" src="../jquery/ui/1.11.2/themes/smoothness/jquery-ui.js"></script>
    
	<?php //**************************************************************************************?>
	

	<?php //Arquivos para o componente DatePicker.?>
	<?php //**************************************************************************************?>
	<!--link type="text/css" href="../jquery/datepicker/css/redmond/jquery-ui-1.8.24.custom.css" rel="stylesheet" /-->
	<script type="text/javascript" src="../jquery/datepicker/js/jquery-ui-1.8.24.custom.min.js"></script>
	<?php //**************************************************************************************?>
	
    
    <?php //Arquivos para o componente SlimBox 2.?>
	<?php //**************************************************************************************?>
    <link rel="stylesheet" href="../jquery/slimbox2/css/slimbox2.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../jquery/slimbox2/js/slimbox2-pt.js"></script>
	<?php //**************************************************************************************?>
	
    
	<?php //Arquivos para o componente CLEditor.?>
	<?php //**************************************************************************************?>
    <script type="text/javascript" src="../jquery/cleditor/jquery.cleditor.min.js"></script>
    <script type="text/javascript" src="../jquery/cleditor/jquery.cleditor.xhtml.min.js"></script>
    <script type="text/javascript" src="../jquery/cleditor/jquery.cleditor.advancedtable.min.js"></script>

    <script type="text/javascript">
        //Controles básicos.
        var CLEditorBasicoControles = "bold italic underline strikethrough | subscript superscript | removeformat | undo redo | link unlink | cut copy paste pastetext | source";
        var CLEditorBasicoFontes = "Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond,Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana";

        //Controles avançados.
        var CLEditorAvancadoControles = "bold italic underline strikethrough | subscript superscript | font size " +
                                        "style | color highlight removeformat | bullets numbering | outdent " +
                                        "indent | alignleft center alignright justify | undo redo | " +
                                        "rule image | link unlink | cut copy paste pastetext | table | print source";
        var CLEditorAvancadoFontes = "Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond,Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana";
    </script>

    <link rel="stylesheet" type="text/css" href="../jquery/cleditor/jquery.cleditor.css" />
	<?php //**************************************************************************************?>
	
	
	<?php //JQuery Validate.?>
	<?php //**************************************************************************************?>
	<?php 
	//Site:
	//http://jqueryvalidation.org/
	
	//Outras opções para pesquisar:
	//http://contactmetrics.com/blog/validate-contact-form-jquery
	//http://formvalidator.net/
	//http://formvalidation.io/
	?>
	<script type="text/javascript" src="../jquery/jqueryvalidate/additional-methods.min.js"></script>
	<script type="text/javascript" src="../jquery/jqueryvalidate/jquery.validate.min.js"></script>
	<?php //**************************************************************************************?>
</head>
    <style type="text/css">
	
    </style>
<body class="PaginaMargemSemMenu">

	<?php echo $page->cphConteudoCabecalho; ?>
    
    <div class="PosConteudoDivisaoSemMenu">
    </div>

	<?php echo $page->cphConteudoPrincipal; ?>
    
</body>
</html>