<?php
//md5 - transforma string em cуdigo hexadecimal de 32 caractйres
//adicionar chave para complicar o cуdigo (sistema_dinamico)

//$token = md5("$salt1$password$salt2");
//consultar pбg 287/307
//obs: aparentemente nгo tem o reverso da funзгo. entгo teria que comprar o string montado (criptografado) com o aramazeando no banco (ou cookie)

//pesquisa SHA-1)
//https://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/

class Crypto
{
	//Encrypt.
	//**************************************************************************************
	function EncryptValue($strValue, $metodoEncrypt = 1)
	{
		$strRetorno = "";
		
		
		//Sem criptografia.
		if($metodoEncrypt == 0)
		{
			$strRetorno = $strValue;
		}
		
		//Hash.
		if($metodoEncrypt == 1)
		{
			//md5
			//md5("$salt1$password$salt2");
			if($GLOBALS['configCryptHash'] == 11)
			{
				$strRetorno = md5($GLOBALS['configCryptChave'] . $strValue . $GLOBALS['configCryptSalt']);
			}
		}
		
		
		//Dados.
		if($metodoEncrypt == 2)
		{
			//MCrypt PHP library.
			if($GLOBALS['configCryptDados'] == 21)
			{
				//$strRetorno = MCryptEncrypt($strValue, "d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282");
				$strRetorno = Crypto::MCryptEncrypt($strValue, $GLOBALS['configCryptChave32byte']);
			}
			
			//Defuse php-encryption.
			if($GLOBALS['configCryptDados'] == 22)
			{
				$strRetorno = Crypto::DefuseEncrypt($strValue, $GLOBALS['configCryptChaveDefusePHPEncryptionRandomKey'], 1);
			}
		}
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Decrypt.
	//**************************************************************************************
	function DecryptValue($strValue, $metodoEncrypt = 2)
	{
		$strRetorno = "";
		
		
		//Sem criptografia.
		if($metodoEncrypt == 0)
		{
			$strRetorno = $strValue;
		}
		
		
		//Dados.
		if($metodoEncrypt == 2)
		{
			//MCrypt PHP library.
			if($GLOBALS['configCryptDados'] == 21)
			{
				//$strRetorno = MCryptDecrypt($strValue, "d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282");
				$strRetorno = Crypto::MCryptDecrypt($strValue, $GLOBALS['configCryptChave32byte']);
			}
			
			//Defuse php-encryption.
			if($GLOBALS['configCryptDados'] == 22)
			{
				$strRetorno = Crypto::DefuseDecrypt($strValue, $GLOBALS['configCryptChaveDefusePHPEncryptionRandomKey'], 1);
			}
		}
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//MCrypt PHP library.
	//http://www.warpconduit.net/2013/04/14/highly-secure-data-encryption-decryption-made-easy-with-php-mcrypt-rijndael-256-and-cbc/
	//**************************************************************************************
	// Encrypt Function
	function MCryptEncrypt($encrypt, $key)
	{
		$encrypt = serialize($encrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM); //windows ou php 5.3
		//$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND); //php 5.2 e linux
		$key = pack('H*', $key);
		$mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
		$passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
		$encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
		return $encoded;
		
		
		//PHP 7.
		////ref: http://php.net/manual/en/mcrypt.examples.php
		
		//$key = "E4HD9h4DhS23DYfhHemkS3Nf";// 24 bit Key
		////$key = $GLOBALS['$configCryptChave32byte'];// 24 bit Key
		//$iv = "fYfhHeDm";// 8 bit IV
		////$input = "Text to encrypt";// text to encrypt
		//$input = $encrypt;// text to encrypt
		//$bit_check=8;// bit amount for diff algor.
		
		////$str= encrypt($input,$key,$iv,$bit_check);
		////echo "Start: $input - Excrypted: $str - Decrypted: ".decrypt($str,$key,$iv,$bit_check);
		
		////function encrypt($text,$key,$iv,$bit_check) {
		//$text_num =str_split($encrypt,$bit_check);
		//$text_num = $bit_check-strlen($text_num[count($text_num)-1]);
		//for ($i=0;$i<$text_num; $i++) {$encrypt = $encrypt . chr($text_num);}
		//$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
		//mcrypt_generic_init($cipher, $key, $iv);
		//$decrypted = mcrypt_generic($cipher,$encrypt);
		//mcrypt_generic_deinit($cipher);
		//return base64_encode($decrypted);
		
		////}
	}
	
	// Decrypt Function
	function MCryptDecrypt($decrypt, $key)
	{
		$decrypt = explode('|', $decrypt.'|');
		$decoded = base64_decode($decrypt[0]);
		$iv = base64_decode($decrypt[1]);
		if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC))
		{
			 return false; 
		}
		$key = pack('H*', $key);
		$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
		$mac = substr($decrypted, -64);
		$decrypted = substr($decrypted, 0, -64);
		$calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
		if($calcmac!==$mac)
		{ 
			return false;
		}
		$decrypted = unserialize($decrypted);
		return $decrypted;
		
		
		//PHP 7.
		////ref: http://php.net/manual/en/mcrypt.examples.php
		
		//$key = "E4HD9h4DhS23DYfhHemkS3Nf";// 24 bit Key
		////$key = $GLOBALS['$configCryptChave32byte'];// 24 bit Key
		//$iv = "fYfhHeDm";// 8 bit IV
		////$input = "Text to encrypt";// text to encrypt
		//$input = $encrypt;// text to encrypt
		//$bit_check=8;// bit amount for diff algor.

		////function decrypt($encrypted_text,$key,$iv,$bit_check){
		//$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
		//mcrypt_generic_init($cipher, $key, $iv);
		//$decrypted = mdecrypt_generic($cipher,base64_decode($decrypt));
		//mcrypt_generic_deinit($cipher);
		//$last_char=substr($decrypted,-1);
		//for($i=0;$i<$bit_check-1; $i++){
			//if(chr($i)==$last_char){
				
				
				
				//$decrypted=substr($decrypted,0,strlen($decrypted)-$i);
				//break;
			//}
		//}
		//return $decrypted;
		////}
	}
	//**************************************************************************************
	
	
	//Defuse php-encryption (criptografar).
	//**************************************************************************************
	function DefuseEncrypt($strDados, $strChave, $tipoCriptografia = 1)
	{
		//$tipoCriptografia: 1 = dados + chave padrгo do sistema
		$strRetorno = "";
		
		
		//Dados + chave padrгo do sistema.
		if($tipoCriptografia == 1)
		{
			$defuseChavePadrao = \Defuse\Crypto\Key::loadFromAsciiSafeString($strChave);
			$strRetorno = \Defuse\Crypto\Crypto::encrypt($strDados, $defuseChavePadrao);
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Defuse php-encryption (decriptografar).
	//**************************************************************************************
	//Encrypt Function
	function DefuseDecrypt($strCipher, $strChave, $tipoCriptografia = 1)
	{
		//$tipoCriptografia: 1 = dados + chave padrгo do sistema
		$strRetorno = "";
		
		
		//Dados + chave padrгo do sistema.
		if($tipoCriptografia == 1)
		{
			$defuseChavePadrao = \Defuse\Crypto\Key::loadFromAsciiSafeString($strChave);
			$strRetorno = \Defuse\Crypto\Crypto::decrypt($strCipher, $defuseChavePadrao);
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
}
?>