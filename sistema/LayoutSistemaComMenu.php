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
<body>
	<?php //Cabeçalho - início.?>
    <div style="position: relative; display: block;">
        <?php //Título sistema.?>
        <div style="background-image:url(img/tb01-02.jpg); background-repeat: repeat-x; height: 63px; width: 100%;">
            <div style="background-image:url(img/tb01-01.jpg); background-repeat:no-repeat; height: 63px; width: 100%;">
                <div style="background-image:url(img/tb01-03.jpg); background-repeat:no-repeat; background-position:right; height: 63px; width: 100%;">
                    <div class="TextoTituloSistema" style="margin-left: 30px; margin-top: 30px; position: absolute;">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeSistema'], "IncludeConfig"); ?><?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?>.
                    </div>
                </div>
            </div>
        </div>
        
        <?php //Links superiores.?>
        <div style="background-image:url(img/tb02-02.jpg); background-repeat: repeat-x; height: 72px; width: 100%;">
            <div style="background-image:url(img/tb02-03.jpg); background-repeat:no-repeat; background-position:right; height: 72px; width: 100%;">
                <div style="background-image:url(img/tb02-01.jpg); background-repeat:no-repeat; height: 72px; width: 100%;">
                    <div class="PosMenuInfoApoio">
                        <a href="CategoriasIndice.php" class="EstiloTreeViewMenuInfoApoio" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPaginaInicialToolTip"); ?>" style="display: block;">
                            &bull; <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPaginaInicial"); ?>
                        </a>
                        <a href="http://www.sistemadinamico.com.br" target="_blank" class="EstiloTreeViewMenuInfoApoio" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuSiteSistemaToolTip"); ?>" style="display: block;">
                            &bull; <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuSiteSistema"); ?>
                        </a>
                        <a href="http://www.sistemadinamico.com.br/port/site_conteudo.asp?id_parent_conteudo=1349" target="_blank" class="EstiloTreeViewMenuInfoApoio" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuContatoToolTip"); ?>" style="display: block;">
                            &bull; <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuContato"); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php //Cabeçalho - fim.?>
    
    
	<?php //Área principal - início.?>
    <div style="position: relative; display: block; /*padding-bottom: 80px;Mesma altura do rodapé.*/ /* background-color: #999; padding: 10px; min-height: 500px;*/ overflow: visible;">
    
        <?php //Coluna esquerda.?>
        <div style="position: relative; display: block;  /*top: 0px; left: 0px; float: left; background-color:#ccc;*/ width: 222px; overflow: hidden;">
			<?php //Links - início.?>
            <div style="position:relative; display: block; margin-top: -24px; background-image:url(img/tb03-01.jpg); background-repeat:no-repeat; /*margin-top: -40px; background-position: top;*/  width: 222px; height: 46px;">
        
            </div>
            <div class="ColunaMenu02">
                <div class="PosLinksLaterais1" style="overflow: hidden;">
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="CategoriasIndice.php?idParentCategorias=0" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuHomeToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuHome"); ?>
                        </a>
                    </div>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaSistemaBusca'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="Busca.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuBuscaToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuBusca"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoProdutos'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="ProdutosManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuProdutosManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuProdutosManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoCadastro'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="CadastroManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuCadastroManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuCadastroManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoHistorico'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="HistoricoManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuHistoricoManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuHistoricoManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['configOrcamentosItens'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="OrcamentosItensIndice.php?idCeOrcamentos=0" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuOrcamentosItensManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuOrcamentosItensManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoPedidos'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="PedidosManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPedidosManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPedidosManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaPostagensIndiceGeral'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="ForumPostagensIndice.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuForumPostagensToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuForumPostagens"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    
                    <?php //Newsletter - e-mails - Listagem Campartilhada. ?>
                    <?php if($GLOBALS['habilitarNewsletterEmailsAvulso'] == 1){ ?>
						<?php if($GLOBALS['configNewsletterEmailsAvulso'] == 0){ ?>
                        <div class="PosLinksLateraisBullet1">
                        
                        </div>
                        <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                            <a href="NewsletterEmailAvulsoGruposIndice.php?idTbNewsletter=0" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailAvulsoIncluir"); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if($GLOBALS['configNewsletterTipoEnvio'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="NewsletterIPsRotativoIndice.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuNewsletterIPsRotativoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuNewsletterIPsRotativo"); ?>
                        </a>
                    </div>
                    <?php } ?>

                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoPaginas'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="PaginasManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPaginasManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPaginasManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoProcessos'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="ProcessosManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuProcessosManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuProcessosManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoTurmas'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="TurmasManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuTurmasManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuTurmasManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoModulos'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="ModulosManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuModulosManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuModulosManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoAulas'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="AulasManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuAulasManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuAulasManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoFluxo'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="FluxoManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuFluxoManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuFluxoManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaManutencaoLog'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="LogManutencao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuLogManutencaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuLogManutencao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaHistoricoIndiceGeral'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="HistoricoIndice.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuHistoricoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuHistorico"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    <?php if($GLOBALS['configMenuSistemaHistoricoFiltrosStatus'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                    	<div class="PosLinksLaterais3">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoTitulo"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoStatus"); ?>
                        </div>
                    </div>
                    <div class="PosLinksLaterais4">
						<?php
                        $arrHistoricoStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 4);
                        ?>
						<?php 
                        for($countArray = 0; $countArray < count($arrHistoricoStatus); $countArray++)
                        {
                        ?>
                        	<?php //if($arrHistoricoStatus[$countArray][0] == $linhaHistorico['id_tb_historico_status']){ ?>
                                <div>
                                    <a href="HistoricoIndice.php?idTbHistoricoStatus=<?php echo $arrHistoricoStatus[$countArray][0];?>" class="EstiloTreeViewMenuFuncoes">
                                        - <?php echo $arrHistoricoStatus[$countArray][1];?>
                                    </a>
                                </div>
                            <?php //} ?>
                        <?php 
                        }
                        ?>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaTarefasIndiceGeral'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="TarefasIndice.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuTarefasToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuTarefas"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaOrcamentosIndiceGeral'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="OrcamentosIndice.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuOrcamentosToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuOrcamentos"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaPedidosIndiceGeral'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="PedidosIndice.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPedidosToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPedidos"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaPedidosParcelasIndiceGeral'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="PedidosParcelasIndice.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPedidosParcelasToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuPedidosParcelas"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaProcessosIndiceGeral'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="ProcessosIndice.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuProcessosToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuProcessos"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaRelatorios'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="RelatoriosIndice.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuRelatoriosToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuRelatorios"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarMenuSistemaImportacao'] == 1){ ?>
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="Importacao.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuImportacaoToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuImportacao"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    <div class="PosLinksLateraisBullet1">
                    
                    </div>
                    <div class="EstiloTreeViewMenuFuncoes PosLinksLaterais2">
                        <a href="LogoffExe.php?paginaRetorno=Login.php" class="EstiloTreeViewMenuFuncoes PosLinksLaterais3" title="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuLogOffToolTip"); ?>">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaMenuLogOff"); ?>
                        </a>
                    </div>
                </div>
                
            </div>
            <?php //Links - fim.?>
			<?php //Créditos?>
            <div class="TextoCopyright" style="background-image:url(img/tb03-03.jpg); background-repeat:no-repeat; background-position: top; width: 100%; height: 100%; /*bottom: -56px; margin-bottom: -112px;float: left;width: 100%; display:table-cell; margin-bottom: 0px; bottom: 0px; */">
                <div style="padding-top: 60px; margin-left: 10px;">
                    Copyright 2008 &reg; <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeDesenvolvedor'], "IncludeConfig"); ?>
                </div>
            </div>
        </div>
        <?php //Coluna esquerda.?>
        
        <?php //Coluna direita.?>
        <div style="position: absolute; display: block; top: 0px; left: 240px; /*  float: right; margin-left: 240px; background-color:#ccc;*/ float: left; overflow: hidden; padding: 0px 10px 10px 0px;">
        	<?php //Título.?>
            <div style="position: relative; display: block;">
                <div style="position: relative; display: block; background-image: url('img/elemento03.jpg'); background-repeat: repeat-x; height: 8px;">
                
                </div>
                <div class="TextoTitulo01" style="position: relative; display: block; padding: 4px 0px 0px 4px;">
                    <?php echo $page->cphConteudoCabecalho; ?>
                </div>
                <div style="position: relative; display: block; background-image: url('img/elemento03.jpg'); background-repeat: repeat-x; height: 8px;">
                
                </div>
            </div>
            
        	<?php //Conteúdo - início.?>
            <div style="position: relative; display: block;">
				<?php echo $page->cphConteudoPrincipal; ?>
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <?php //Conteúdo - fim.?>
        </div>
        <?php //Coluna direita.?>
    
    </div>
	<?php //Área principal - fim.?>


</body>
</html>