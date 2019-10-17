<?php
//seção time out
//ini_set('session.gc_maxlifetime', 60 * 60 * 24);

//opção para aumetar a segurança, ao definir um ip para a seção:
//$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
// complemento de verificação: if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) different_user();

class CookiesFuncoes
{
	//Rotina para criação de cookie.
	//**************************************************************************************
	function CookieCriar($cookieNome, $cookieValor, $loginConexao = "")
	{
		$cookiePeriodo = 0; //time() + (86400 * 30) | 0 (86400 = 1 dia)
		
		//Ficar conectado.
		if($loginConexao == "1")
		{
			$cookiePeriodo = time() + (86400 * 30 * 365);
		}
		
		if($GLOBALS['configCookieTipoGravacao'] == "1")
		{
			setcookie($cookieNome, $cookieValor, $cookiePeriodo, $GLOBALS['configCookieDiretorio']);
			//setcookie($cookieNome, $cookieValor, $cookiePeriodo, $GLOBALS['configCookieDiretorio'], false);
		}else{
			setcookie($cookieNome, $cookieValor, $cookiePeriodo);
			//setcookie($cookieNome, $cookieValor, $cookiePeriodo, false);
		}
		
		//Recuro para garantir que o cookie será definido no primeiro carregamento.
		$_COOKIE[$cookieNome] = $cookieValor; 
		
	}
	//**************************************************************************************
	
	
	//Rotina para exclusão de cookie.
	//**************************************************************************************
	function CookieExcluir($cookieNome)
	{
		$cookiePeriodo = time() - 3600;
		
		if($GLOBALS['configCookieTipoGravacao'] == "1")
		{
			setcookie($cookieNome, "", $cookiePeriodo, $GLOBALS['configCookieDiretorio']);
		}else{
			setcookie($cookieNome, "", $cookiePeriodo);
		}
		
		//Recuro para garantir que o cookie será definido no primeiro carregamento.
		$_COOKIE[$cookieNome] = ""; 
	}
	//**************************************************************************************
	
	
	//Rotina para criação de id temporário.
	//**************************************************************************************
	function IdTbCadastroTemporario_CookieCriar()
	{
		$idTbCadastroTemporarioCookie = "";
		
		//if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario") <> "")
		//{
			$idTbCadastroTemporarioCookie = CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario");
		//}
		
		if($idTbCadastroTemporarioCookie == "")
		{
			$idTbCadastroTemporarioCookieValor = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01(ContadorUniversal::ContadorUniversalUpdate(1)), 2);
			
			CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario", $idTbCadastroTemporarioCookieValor, "");			
		}
		
		//Verificação de erro - debug.
		//echo "idTbCadastroTemporarioCookie=" . $idTbCadastroTemporarioCookie . "<br>";
	}
	//**************************************************************************************

	
	//Função para resgatar valor de um cookie.
	//**************************************************************************************
	function CookieValorLer($nomeCookie = "")
	{
		$strRetorno = "";
		
		if($nomeCookie <> "")
		{
			//if(isset($_COOKIE[$nomeCookie]))
			//{
				$strRetorno = $_COOKIE[$nomeCookie];
			//}
		}
		
		if($nomeCookie == "")
		{
			//Restatar valores de cookie de login.
			if($strRetorno == "")
			{
				$strRetorno = CookiesFuncoes::CookieValorLer_Login();
			}

			//Temporário.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario"];
			}
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para resgatar valor de um cookie de login.
	//**************************************************************************************
	function CookieValorLer_Login()
	{
		$strRetorno = "";
			//Cliente.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente"];
			}
			
			//Usuário.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario"];
			}
			
			//Usuário.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario2"];
			}
			//Usuário.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario3"];
			}
			//Usuário.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario4"];
			}
			//Usuário.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario5"];
			}

			//Usuário Vendendor.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioVendedor"];
			}
			//Usuário RH.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioRH"];
			}
			//Usuário Assinante.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroAssinante"];
			}
			//Usuário Simples.
			if($strRetorno == "")
			{
				$strRetorno = $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbCadastroSimples"];
			}
		return $strRetorno;
	}
	//**************************************************************************************


	//Exclusão dos cookies de login.
	//**************************************************************************************
	function CookieLogin_Logoff()
	{
		$strRetorno = false;
		
		//Cookies de níveis de usuário.
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente");
		
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario");
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario2");
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario3");
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario4");
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario5");

		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioVendedor");
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioRH");
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroAssinante");
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroSimples");
		
		//Limpar cookie do endereço de referencia armazenado.
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "URLReferenciaLogin");
		
		//Limpar os cookies do aplicativo.
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "APPUserId");	
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "APPUserKey");	
		
		$strRetorno = true;
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Exclusão dos cookies de login.
	//**************************************************************************************
	function CookieLogin_Verificar()
	{
		$strRetorno = false;
		
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente") <> ""){
			$strRetorno = true;
		}
		
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){
			$strRetorno = true;
		}
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario2") <> ""){
			$strRetorno = true;
		}
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario3") <> ""){
			$strRetorno = true;
		}
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario4") <> ""){
			$strRetorno = true;
		}
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario5") <> ""){
			$strRetorno = true;
		}
		
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioVendedor") <> ""){
			$strRetorno = true;
		}
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioRH") <> ""){
			$strRetorno = true;
		}
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroAssinante") <> ""){
			$strRetorno = true;
		}
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroSimples") <> ""){
			$strRetorno = true;
		}		
		
		return $strRetorno;
	}
	//**************************************************************************************	
}

?>