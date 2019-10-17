<?php
//Importação dos arquivos de configuração.
require_once "../IncludeConfig.php"; //Deve vir antes do db.
require_once "../IncludeConexao.php";
require_once "../IncludeFuncoes.php";
//require_once "../IncludeUsuarioVerificacao.php";
require_once "../IncludeLayout.php";

/*
require_once __DIR__."/../IncludeConfig.php"; //Deve vir antes do db.
require_once __DIR__."/../IncludeConexao.php";
require_once __DIR__."/../IncludeFuncoes.php";
require_once __DIR__."/../IncludeUsuarioVerificacao.php";
require_once __DIR__."/../IncludeLayout.php";

require_once "/home/jmrj/public_html/sistema/IncludeConfig.php";
require_once "/home/jmrj/public_html/sistema/IncludeConexao.php";
require_once "/home/jmrj/public_html/sistema/IncludeFuncoes.php";
require_once "/home/jmrj/public_html/sistema/IncludeUsuarioVerificacao.php";
require_once "/home/jmrj/public_html/sistema/IncludeLayout.php";
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaUsuarios"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
    </title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="../EstilosSistemaLayout.css" rel="stylesheet" type="text/css" />
    <link href="../EstilosSistema.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="PosIframePrincipal"> 
        <iframe src="../UsuariosLogin.php" scrolling="auto" name="frame_sistema" frameborder="0" align="left" width="100%" height="100%" />
    </div>
</body>
</html>

<?php
//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>
