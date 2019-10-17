<?php
//Definição de variáveis.
$TipoLogin = $includeLogin_tipoLogin;
$OrigemLogin = $includeLogin_origemLogin; //1 - página de login | 2 - carrinho de compras | 3 - Outros
if(empty($OrigemLogin))
{
	$OrigemLogin = 1;
}

$paginaRetornoLogin = $includeLogin_paginaRetornoLogin;
$idRetornoLogin = $includeLogin_idRetornoLogin;


if($OrigemLogin == "1")
{
	$paginaRetornoLogin = "SiteAdm.php";
}
if($OrigemLogin == "2")
{
	$paginaRetornoLogin = "SiteCarrinho.php";
}


//Verificação de erro - debug.
//echo "TipoLogin=" . $TipoLogin . "<br />";
//echo "OrigemLogin=" . $OrigemLogin . "<br />"; 
//echo "paginaRetornoLogin=" . $paginaRetornoLogin . "<br />";
//echo "idRetornoLogin=" . $idRetornoLogin . "<br />";
?>

<form name="formLogin" id="formLogin" action="SiteLoginExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
	
	<?php //Diagramação 1.?>
    <?php //**************************************************************************************?>
	<?php if($TipoLogin == "1"){ ?>
        <div align="center" class="LoginTexto">
            <table border="0" cellpadding="0" cellspacing="1">
                <tr>
                    <td colspan="2">
                        <div align="left" class="LoginTitulo">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginTitulo"); ?>:
                        </div>
                        <div class="LoginSeparador1">
                        </div>
                    </td>
                </tr>
                
                <?php if($habilitarCadastroUsuario == "1"){ ?>
                    <tr>
                        <td width="50">
                            <div align="left">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginUsuario"); ?>:
                            </div>
                        </td>
                        <td>
                            <input type="text" id="usuario" name="usuario" size="255" class="LoginCampoTexto" />
                        </td>
                    </tr>
                <?php }else{ ?>
                    <tr>
                        <td width="50">
                            <div align="left">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginEmail"); ?>:
                            </div>
                        </td>
                        <td>
                            <input type="text" id="email" name="email" size="255" class="LoginCampoTexto" />
                        </td>
                    </tr>
                <?php } ?>
    
                <tr>
                    <td>
                        <div align="left">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginSenha"); ?>:
                        </div>
                    </td>
                    <td>
                        <input type="password" id="senha" name="senha" size="255" class="LoginCampoTexto" />
                    </td>
                </tr>
    
                <tr>
                    <td colspan="2">
                        <div align="center" style="margin-top: 5px; /*margin-left: 43px; float: left;*/">
                        	<div class="AdmDivBto01" onclick="btoClick_onEvent('btoLogin');">
                                <a class="AdmLinks01">
                                    Login
                                </a>
                            </div>
                        	<input id="btoLogin" type="image" name="submit" value="Submit" src="img/btoLogin.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoLogin"); ?>" style="display: none;" />
                            
                            <input type="hidden" id="origemLogin" name="origemLogin" value="<?php echo $OrigemLogin; ?>" />
                            <input type="hidden" id="paginaRetornoLogin" name="paginaRetornoLogin" value="<?php echo $paginaRetornoLogin; ?>" />
                            <input type="hidden" id="idRetornoLogin" name="idRetornoLogin" value="<?php echo $idRetornoLogin; ?>" />
                        </div>
                        <div align="center" style="margin-top: 5px; /*float: right;*/ display: none;">
                            <?php if(CookiesFuncoes::CookieLogin_Verificar() == true){ ?>
                            	<a href="SiteAdm.php" class="LoginLinks">
                                	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTitulo"); ?>
                                </a>
                                    |
							<?php } ?> 
                            <a href="SiteLoginLembrar.php" class="LoginLinks">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginLembrar"); ?>
                            </a> 
                            <span style="display: none;">
                                 | 
                                <a href="SiteCadastro.php?idTipoCadastro=<?php echo $configIdCadastroUsuario;?>&idTbCadastro=3519&idTbCadastroTemporario=<?php ?>" class="LoginLinks">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginCadastro"); ?>
                                </a>
                            </span>
                        </div>
                        
                        <div align="center" id="divNavegadorZoom" style="position: relative; display: block; margin-top: 20px;">
                        	<div style="position: relative; display: inline-block;">
                            	<div style="margin-top: 12px; margin-right: 4px;">
                                    Zoom: 
                                </div>
                            </div>
                            
                        	<div class="AdmDivBto01" onclick="NavegadorZoomOut();" style="min-width: 14px; vertical-align: top;">
                                <a class="AdmLinks01" style="color: #4a7db1; font-weight: bold; font-size: 20px;">
                                    -
                                </a>
                            </div>
                        	<div class="AdmDivBto01" onclick="NavegadorZoomIn();" style="min-width: 14px; vertical-align: top;">
                                <a class="AdmLinks01" style="color: #4a7db1; font-weight: bold; font-size: 20px;">
                                    +
                                </a>
                            </div>
                            
                            <a onclick="NavegadorZoomOut()" style="text-decoration: none; cursor: pointer; display: none;">
                            	<img src="img/btoNavegadorZoomOut.png" alt="Zoom Out" />
                            </a>
                            <a onclick="NavegadorZoomIn()" style="text-decoration: none; cursor: pointer; display: none;">
                            	<img src="img/btoNavegadorZoomIn.png" alt="Zoom In" />
                            </a>
                        </div>
                        
                        <script type="text/javascript">
                        $.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase());
                        //alert($.browser.chrome);
                        if($.browser.chrome)
                        {
                            
                        }else{
                            //divHide('linkNavegadorZoomOut');
                            //divHide('linkNavegadorZoomIn');
                            divHide('divNavegadorZoom');
                        }
                        </script>
                    </td>
                </tr>
    
            </table>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
    
    
	<?php //Diagramação 4 - Vertical (tableless).?>
    <?php //**************************************************************************************?>
	<?php if($TipoLogin == "4"){ ?>
        <div class="LoginTexto">
            <div align="left" class="LoginTitulo">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginTitulo"); ?>:
            </div>
            <div class="LoginSeparador1">
            </div>
            
            <?php if($habilitarCadastroUsuario == "1"){ ?>
                <?php //Usuário. ?>
                <div align="left" style="position: relative; display: block; vertical-align: top; margin-right: 4px;">
                    <div>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginUsuario"); ?>:
                    </div>
                    <div>
                        <input type="text" id="usuario" name="usuario" size="255" class="LoginCampoTexto" style="width: 100%;" />
                    </div>
                </div>
            <?php }else{ ?>
                <?php //e-mail. ?>
                <div align="left" style="position: relative; display: block; vertical-align: top; margin-right: 4px;">
                    <div>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginEmail"); ?>:
                    </div>
                    <div>
                        <input type="text" id="email" name="email" size="255" class="LoginCampoTexto" style="width: 100%;" />
                    </div>
                </div>
            <?php } ?>
                        
            <?php //Senha. ?>
            <div align="left" style="position: relative; display: block; vertical-align: top; margin-right: 4px; margin-top: 10px;">
                <div>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginSenha"); ?>:
                </div>
                <div>
                    <input type="password" id="senha" name="senha" size="255" class="LoginCampoTexto" style="width: 100%;" />
                </div>
            </div>
                        
            <?php //Botão. ?>
            <div align="center" style="position: relative; display: inline-block; width: 100%;">
                <div align="center" style="margin-top: 5px; /*margin-left: 43px; float: left;*/">
                    <input type="image" name="submit" value="Submit" src="img/btoLogin.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoLogin"); ?>" />
                    
                    <input type="hidden" id="paginaRetornoLogin" name="paginaRetornoLogin" value="<?php echo $paginaRetornoLogin; ?>" />
                    <input type="hidden" id="idRetornoLogin" name="idRetornoLogin" value="<?php echo $idRetornoLogin; ?>" />
                </div>
                <div align="center" style="margin-top: 5px; /*float: right;*/">
                    <!--%If CookiesFuncoes.CookieLogin_Verificar = True Then%-->
                        <a href="SiteAdm.php" class="LoginLinks">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTitulo"); ?>
                        </a> 
                            |
                    <!--%End If%-->
                    <a href="SiteLoginLembrar.php" class="LoginLinks">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginLembrar"); ?>
                    </a> 
                     | 
                    <a href="SiteCadastro.php?idTipoCadastro=<?php echo $configIdCadastroUsuario;?>&idTbCadastro=3519&idTbCadastroTemporario=<?php ?>" class="LoginLinks">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginCadastro"); ?>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php //**************************************************************************************?>
</form>
<?php

?>