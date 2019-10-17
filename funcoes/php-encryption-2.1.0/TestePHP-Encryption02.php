<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


use \Defuse\Crypto\Crypto;

//require "vendor/autoload.php";
require_once "src/Core.php";
require_once "src/Crypto.php";
require_once "src/DerivedKeys.php";
require_once "src/Encoding.php";
require_once "src/File.php";
require_once "src/Key.php";
require_once "src/KeyOrPassword.php";
require_once "src/KeyProtectedByPassword.php";
require_once "src/RuntimeTests.php";



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Do this once then store it somehow:
$key = Key::createNewRandomKey();

$message = 'We are all living in a yellow submarine';

$ciphertext = Crypto::encrypt($message, $key);
$plaintext = Crypto::decrypt($ciphertext, $key);

var_dump($ciphertext);
var_dump($plaintext);
?>