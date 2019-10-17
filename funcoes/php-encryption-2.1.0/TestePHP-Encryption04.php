<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


//use \Defuse\Crypto\Crypto;
//use \Defuse\Crypto\Crypto;
//use \Defuse\Crypto\Key;

require "autoload.php";



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$secret_data = "informacaoSecretaçá com acentos e tal";
$teste_valor = "sistema";

//$key = Crypto::createNewRandomKey();
//$key = Key::createNewRandomKey(); //funcionando.
$keyNew = \Defuse\Crypto\Key::createNewRandomKey(); //funcionando.
$key = \Defuse\Crypto\Key::loadFromAsciiSafeString("def000006516cef316c508a843b1362ab79f4fe36a7294070c4c054c16fcab1537fb7ea3cbd6e32526b86e08e7d2906f2303a538eebc48c2944f8e7442886813e25ffab3");

//$storeMe = bin2hex($key);
$storeMe = $key->saveToAsciiSafeString(); //funcionando.

$ciphertext = \Defuse\Crypto\Crypto::encrypt($secret_data, $key);
$plaintext = \Defuse\Crypto\Crypto::decrypt($ciphertext, $key);


$teste_valor_encrypt = \Defuse\Crypto\Crypto::encrypt($teste_valor, $key);


echo "teste=" . "20" . "<br />";
//echo __DIR__;
//echo "ciphertext=" . $ciphertext . "<br />";
//echo "key=" . $key . "<br />";
echo "teste_valor_encrypt=" . $teste_valor_encrypt . "<br />";
echo "storeMe=" . $storeMe . "<br />"; //def000006516cef316c508a843b1362ab79f4fe36a7294070c4c054c16fcab1537fb7ea3cbd6e32526b86e08e7d2906f2303a538eebc48c2944f8e7442886813e25ffab3
//print_r($storeMe);
//print_r($key);
//var_dump($storeMe);
var_dump($key);
var_dump($keyNew);
var_dump($ciphertext);
var_dump($plaintext);
var_dump(__DIR__);
?>