<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
    </title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="EstilosSistemaLayout.css" rel="stylesheet" type="text/css" />
    <link href="EstilosSistema.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="PosIframePrincipal"> 
        <iframe src="Login.php" scrolling="auto" name="frame_sistema" frameborder="0" align="left" width="100%" height="100%" />
    </div>
</body>
</html>

<?php
//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>