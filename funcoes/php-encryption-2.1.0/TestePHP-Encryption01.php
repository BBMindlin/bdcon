<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


//use \Defuse\Crypto;
//use \Defuse\Crypto\Crypto;
//use \Defuse\Crypto\Key;
//use \Defuse\Crypto\Exception;

use \Defuse\Crypto\Core;
use \Defuse\Crypto\Crypto;
use \Defuse\Crypto\Key;
use Defuse\Crypto\Exception as Ex;
//use Defuse\Crypto\Exception;
//use \Defuse\Crypto\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

///*
require_once "src/Core.php";
require_once "src/Crypto.php";
require_once "src/DerivedKeys.php";
require_once "src/Encoding.php";
require_once "src/File.php";
require_once "src/Key.php";
require_once "src/KeyOrPassword.php";
require_once "src/KeyProtectedByPassword.php";
//require_once "src/RuntimeTests.php";
//*/
//require_once "src/BadFormatException.php";
//require_once "src/CryptoException.php";
//require_once "src/EnvironmentIsBrokenException.php";
//require_once "src/IOException.php";
//require_once "src/WrongKeyOrModifiedCiphertextException.php";


//require_once "src/Exception/BadFormatException.php";
//require_once "src/Exception/CryptoException.php";
//require_once "src/Exception/EnvironmentIsBrokenException.php";
//require_once "src/Exception/IOException.php";
//require_once "src/Exception/WrongKeyOrModifiedCiphertextException.php";
//require_once "psalm.xml";




/*
function loadEncryptionKeyFromConfig()
{
    $keyAscii = // ... load the contents of /etc/daveapp-secret-key.txt
    return Key::loadFromAsciiSafeString($keyAscii);
}
*/



$secret_data = "informacaoSecreta";

//$key = "sistema";
//$key = "0dc6ecb7ff00ac21b63c8ff07650a211";
//$key = "12345678910";
//$key = Crypto::CreateNewRandomKey();
//$key = Key::CreateNewRandomKey();
//$key = \Defuse\Crypto\Key::CreateNewRandomKey();
//$key->saveToAsciiSafeString();

//$key = CreateNewRandomKey();
$key = Key::createNewRandomKey();
//$key->saveToAsciiSafeString();
//$key = \Defuse\Crypto\Crypto::CreateNewRandomKey();
//$key = \Defuse\Crypto\Key::CreateNewRandomKey();



//$ciphertext = Crypto::encryptWithPassword($secret_data, "sistema");




$ciphertext = Crypto::encrypt($secret_data, $key);
//$ciphertext = \Defuse\Crypto\Crypto::encrypt($secret_data, $key);

//echo "teste=" . "05" . "<br />";
//echo "ciphertext=" . $ciphertext . "<br />";
//echo "key=" . $key . "<br />";
//print_r($key);
var_dump($key);
var_dump($ciphertext);
?>