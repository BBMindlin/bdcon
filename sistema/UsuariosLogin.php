<?php

//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuarios"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
    </title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="EstilosSistemaLayout.css" rel="stylesheet" type="text/css" />
    <link href="EstilosSistema.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		.BodyMaster03
		{
			margin: 0;
			/*background-color: #78c3ae;*/
		}
	</style>
</head>
<body class="BodyMaster03">
	<div style="position: absolute; width:100%; height:270px; margin-top: -135px; margin-left: auto; margin-right: auto; top: 50%; /*background-color: #cccccc;  margin-left: -678px; left: 50%;*/">
        <div style="position:absolute; display: block; background-image: url(img/elemento01.jpg); background-position: top; background-repeat: repeat-x;  height: 13px; width: 100%; top: 0px; z-index: 2;">
        
        </div>
        
        <div style="position:absolute; display: block; background-image: url(img/elemento02.jpg); background-position: top; background-repeat: repeat-x;  height: 13px; width: 100%; bottom: 0px; z-index: 2;">
        
        </div>
        
        <!--Conteúdo.-->
        <div style="position: relative; display: table; height: 100%; width: 100%; padding-top: 18px; padding-bottom: 18px; top: 0px; vertical-align: middle; z-index: 1; /*background-color: #333;  padding-left: 10px; padding-right: 10px;*/">
			<table border="0" cellspacing="10" cellpadding="0" style="position: relative; height: 100%; width: 100%;">
              <tr>
                <td width="1">
                	<img src="img/logo_cliente.jpg" alt="Logomarca" />
                </td>
                <td style="position: relative;">
                	<!--Título.-->
                    <div class="PosLoginTitulo01" style="position: absolute; display: block; top: 0px;">
                    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuariosGerenciamento"); ?>
                    </div>
                
                	<!--Mensagens.-->
                	<div align="center" style="position: absolute; display: block; top: 34px; left: 0px; right: 0px;">
                        <div align="center" class="TextoErro">
                            <?php echo $mensagemErro;?>
                        </div>
                        <div align="center" class="TextoSucesso">
                            <?php echo $mensagemSucesso;?>
                        </div>
                    </div>
                    
                    <!--Login.-->
                	<div align="right" style="position: absolute; display: block; bottom: 0px; right: 0px;">
                        <form name="formUsuariosLogin" id="formUsuariosLogin" action="UsuariosLoginExe.php" method="post" class="FormularioTabela01">
                            <table border="0" cellpadding="0" cellspacing="1" align="right">
                                <tr> 
                                    <td>
                                        <div align="right" class="TextoLogin01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaLoginSenha"); ?>:
                                        </div>
                                    </td>
                                    <td>
                                    	<input type="password" name="senha" id="senha" class="CampoTexto01" maxlength="255" />
                                    </td>
                                </tr>
                                <tr> 
                                    <td>&nbsp;</td>
                                    <td>
                                        <div align="right">
                                            <input type="image" name="submit" value="Submit" src="img/bto_login.jpg" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoLogin"); ?>" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </td>
              </tr>
            </table>
        </div>
        <!--Conteúdo.-->
    </div>
</body>
</html>
<?php
//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>