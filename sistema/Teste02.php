<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";

//Recurso para forçar exibição de erro, caso o servidor não esteja exibindo os erros.
//----------------------
//ini_set('display_errors', 1); //Mostra todos os erros.
//error_reporting(0); //Ocultar todos erros.
//error_reporting(E_ALL); //alpshost
//error_reporting(E_STRICT & ~E_STRICT); //Locaweb Linux 5.4
//error_reporting(E_ALL | E_STRICT);
//error_reporting(error_reporting() & ~E_NOTICE);

//Resumido - forte.
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//----------------------



//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroCliente = $_GET["idTbCadastroCliente"];

$paginaRetorno = "PedidosIndice.php";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroCliente=" . $idTbCadastroCliente . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSelect=" . $masterPageSelect . 
"&variavelRetorno=" . $variavelRetorno;

$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.



//Verificação de erro - debug.
//echo "debug=" . "9" . "<br />";
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "idParentPedidos=" . $idParentPedidos . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	Teste01
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>

	<?php
    echo "configTituloCadastroIc1=" . htmlentities($GLOBALS['configTituloCadastroIc1']) . "<br />";
    echo "configTituloCadastroIc40=" . htmlentities($GLOBALS['configTituloCadastroIc40']) . "<br />";
    echo "configTituloCadastroIc40=" . htmlentities($GLOBALS['configTituloCadastroIc40']) . "<br />";
    echo "configTituloTeste=" . htmlentities($GLOBALS['configTituloTeste']) . "<br />";
	
	
	//Teste criptografia.
	$strSenhaSistemaCriptografada = "CHYvdyfhKdWEwy+6ktvVJFNVuxjNKxB8AOL+NkN1h7Ux47vLwndIabC9TFLQAwiCVw3hAFL4pOgP1v6YYC6/A860isLxT2GXb+cRvnduyLpeTGt60NAxP1h/ya/eZ2TN|072ZgBHkFbUWCB972kXzcPV1uABNJ1+O9Q8zaTjL6Ac=";
    echo "strSenhaSistemaCriptografada=" . $strSenhaSistemaCriptografada . "<br />";
	echo "EncryptValue=" . Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01("sistema"), $GLOBALS['configUsuariosMetodoSenha']) . "<br />";
	echo "EncryptValue=" . Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01("Text to encrypt"), $GLOBALS['configUsuariosMetodoSenha']) . "<br />";
    //echo "DecryptValue (MCrypt)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($strSenhaSistemaCriptografada, 2), 2) . "<br />";
    //echo "DecryptValue (MCrypt)=" . Crypto::DecryptValue($strSenhaSistemaCriptografada, 2) . "<br />";
    //echo "configCryptTipo=" . $GLOBALS['configCryptTipo'] . "<br />";
    //echo "configCryptChave32byte=" . $GLOBALS['configCryptChave32byte'] . "<br />";
    //echo "DecryptValue=" . Crypto::DecryptValue("|GNkFPMKosy2KSY7Dsg4GPUtUrticGebPIpkk3Lb/pV8=", 2) . "<br />";
    echo "DecryptValue (MCrypt)=" . Crypto::DecryptValue("wW+yb6z82E8=", 2) . "<br />";
    echo "DecryptValue (MCrypt)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura("wW+yb6z82E8=", 2), 2) . "<br />";
    echo "DecryptValue (MCrypt)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura("wW+yb6z82E8=", 2), 2) . "<br />";
	
	
	$cipherText = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01("teste com criptografiaçá e tal"), 2);
	//echo "EncryptValue(php-encryption)=" . Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01("teste com criptografia"), 3) . "<br />";
	//echo "configCryptDefusePHPEncryptionRandomKey=" . $GLOBALS['configCryptDefusePHPEncryptionRandomKey'] . "<br />";
	//echo "DefuseEncrypt=" . Crypto::DefuseEncrypt("teste", $GLOBALS['$configCryptChaveDefusePHPEncryptionRandomKey'], 1) . "<br />";
	echo "cipherText (php-encryption)=" . $cipherText . "<br />";
	echo "DecryptValue (php-encryption)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($cipherText), 2) . "<br />";

	
	//Crypto::MCryptDecrypt($strValue, $GLOBALS['$configCryptChave32byte']);
	$key = $GLOBALS['$configCryptChave32byte'];
	$decrypt = $strSenhaSistemaCriptografada;
	/*
	$decrypt = explode('|', $decrypt.'|');
	$decoded = base64_decode($decrypt[0]);
	$iv = base64_decode($decrypt[1]);
	if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
	$key = pack('H*', $key);
	$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
	$mac = substr($decrypted, -64);
	$decrypted = substr($decrypted, 0, -64);
	$calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
	if($calcmac!==$mac){ return false; }
	$decrypted = unserialize($decrypted);
	echo "DecryptValue=" . $decrypted . "<br />";
	*/
	
	
	
$key = "E4HD9h4DhS23DYfhHemkS3Nf";// 24 bit Key
//$key = $GLOBALS['$configCryptChave32byte'];// 24 bit Key
$iv = "fYfhHeDm";// 8 bit IV
$input = "Text to encrypt";// text to encrypt
$bit_check=8;// bit amount for diff algor.

$str= encrypt($input,$key,$iv,$bit_check);
echo "Start: $input - Excrypted: $str - Decrypted: ".decrypt($str,$key,$iv,$bit_check) . "<br />";
echo "encrypt = ".encrypt("sistema",$key,$iv,$bit_check) . "<br />";

function encrypt($text,$key,$iv,$bit_check) {
$text_num =str_split($text,$bit_check);
$text_num = $bit_check-strlen($text_num[count($text_num)-1]);
for ($i=0;$i<$text_num; $i++) {$text = $text . chr($text_num);}
$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
mcrypt_generic_init($cipher, $key, $iv);
$decrypted = mcrypt_generic($cipher,$text);
mcrypt_generic_deinit($cipher);
return base64_encode($decrypted);
}

function decrypt($encrypted_text,$key,$iv,$bit_check){
$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
mcrypt_generic_init($cipher, $key, $iv);
$decrypted = mdecrypt_generic($cipher,base64_decode($encrypted_text));
mcrypt_generic_deinit($cipher);
$last_char=substr($decrypted,-1);
for($i=0;$i<$bit_check-1; $i++){
    if(chr($i)==$last_char){
        
        
        
        $decrypted=substr($decrypted,0,strlen($decrypted)-$i);
        break;
    }
}
return $decrypted;
}

	?>

<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>