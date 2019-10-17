<?php
class LoginAutenticacao
{
	
	//Rotina para verificação de sessão de usuário do sistema.
	//**************************************************************************************
	function UsuarioLoginVerificacao()
	{
	
		if(!isset($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuario']]))
		{
	
			$GLOBALS['dbSistemaConPDO'] = null;
			
	
			//Montagem do URL de retorno.
			$URLRetorno = $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . "Login.php" . "?" .
			"mensagemSucesso=" . $mensagemSucesso .
			"&mensagemErro=" . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusErro20");


			//Redirecionamento de página.
			//exit();
			header("Location: " . $URLRetorno);
			die();
			exit;
	
		}else{
			//echo "Existe<br>";
		}
	}
	//**************************************************************************************
	
	
	//Rotina para verificação de sessão de usuário master do sistema.
	//**************************************************************************************
	function UsuarioMasterLoginVerificacao()
	{
	
		if(!isset($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']]))
		{
	
			//echo "Não Existe <br>";
			
			//Recurso para permitir o redirecionamento (evitar duplicidade de header).
			//ob_start();
	
			//Fechamento da conexão.
			//mysqli_close($dbSistemaCon);
			//$dbSistemaConMysqli->close();
			//$dbSistemaConPDO = null;
			$GLOBALS['dbSistemaConPDO'] = null;
			
	
			//Montagem do URL de retorno.
			$URLRetorno = $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . "UsuariosLogin.php" . "?" .
			"mensagemSucesso=" . $mensagemSucesso .
			"&mensagemErro=" . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusErro20");
			
			
			//Limpeza do buffer de saída.
			/*
			while (ob_get_status()) 
			{
				ob_end_clean();
			}
			*/
			
			//Verificação de erro - debug.
			//echo 
			
			//Redirecionamento de página.
			//exit();
			header("Location: " . $URLRetorno);
			die();
			exit;
	
		}else{
			//echo "Existe<br>";
		}
	}
	//**************************************************************************************


	//Rotina para verificação de cookie de cadastro do site.
	//**************************************************************************************
	function CadastroLoginVerificacao($_visualizacaoAtivaSistema = "")
	{
		//_visualizacaoAtivaSistema: frontend | mobile
		if($_visualizacaoAtivaSistema == "mobile")
		{
			$_visualizacaoAtivaSistema = $GLOBALS['visualizacaoAtivaMobile'];
		}
		if($_visualizacaoAtivaSistema == "")
		{
			$_visualizacaoAtivaSistema = $GLOBALS['visualizacaoAtivaSistema'];
		}


		//Definição de link acessado.
		if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "URLReferenciaLogin") == "")
		{
			$URLReferenciaLogin = $_SERVER['REQUEST_URI']; //ex: /pt/SiteAdmAulasAdministrar.php?idTbAulas=3860
			//$URLReferenciaLogin = $_SERVER['HTTP_REFERER'];
			CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "URLReferenciaLogin", $URLReferenciaLogin); //Criação do cookie.
		}

		
		if(CookiesFuncoes::CookieValorLer_Login() == "")
		{
			//Definição de variáveis.
			$paginaRetorno = "SiteLogin.php";
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginMensagemErro03");
			
			$GLOBALS['dbSistemaConPDO'] = null;
			
			//Montagem do URL de retorno.
			//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
			//$URLRetorno = $GLOBALS['configUrl'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . $paginaRetorno . "?" .
			$URLRetorno = $GLOBALS['configUrl'] . "/" . $_visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
			"mensagemSucesso=" . $mensagemSucesso .
			"&mensagemErro=" . $mensagemErro;
			
			//Redirecionamento de página.
			//exit();
			header("Location: " . $URLRetorno);
			die();
		}else{
			//Limpar cookie do endereço de referencia armazenado.
			//CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "URLReferenciaLogin");	
		}
	}
	//**************************************************************************************
	
	
	//Função para verificar autenticação de cadastro.
	//**************************************************************************************
	function AutenticacaoAPI($_idTbCadastro, $_apiKey, $metodoVerificacao = 1)
	{
		//metodoVerificacao: 1 - convencional (_apiKey = senha)
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		$strSqlCadastroSelect = "";
		//----------
		
		
		//Query de pesquisa.
		//----------
		$strSqlCadastroSelect .= "SELECT ";
		$strSqlCadastroSelect .= "id, ";
		/*
		$strSqlCadastroSelect .= "id_tb_categorias, ";
		//$strSqlCadastroSelect .= "id_parent_cadastro, ";
		$strSqlCadastroSelect .= "data_cadastro, ";
		$strSqlCadastroSelect .= "pf_pj, ";
		$strSqlCadastroSelect .= "nome, ";
		$strSqlCadastroSelect .= "sexo, ";
		$strSqlCadastroSelect .= "altura, ";
		$strSqlCadastroSelect .= "peso, ";
		$strSqlCadastroSelect .= "razao_social, ";
		$strSqlCadastroSelect .= "nome_fantasia, ";
		$strSqlCadastroSelect .= "data_nascimento, ";
		$strSqlCadastroSelect .= "cpf_, ";
		$strSqlCadastroSelect .= "rg_, ";
		$strSqlCadastroSelect .= "cnpj_, ";
		$strSqlCadastroSelect .= "documento, ";
		$strSqlCadastroSelect .= "i_municipal, ";
		$strSqlCadastroSelect .= "i_estadual, ";
		
		$strSqlCadastroSelect .= "endereco_principal, ";
		$strSqlCadastroSelect .= "endereco_numero_principal, ";
		$strSqlCadastroSelect .= "endereco_complemento_principal, ";
		$strSqlCadastroSelect .= "bairro_principal, ";
		$strSqlCadastroSelect .= "cidade_principal, ";
		$strSqlCadastroSelect .= "estado_principal, ";
		$strSqlCadastroSelect .= "pais_principal, ";
		$strSqlCadastroSelect .= "cep_principal, ";
		
		$strSqlCadastroSelect .= "ponto_referencia, ";
		*/
		$strSqlCadastroSelect .= "email_principal, ";
		/*
		$strSqlCadastroSelect .= "tel_ddd_principal, ";
		$strSqlCadastroSelect .= "tel_principal, ";
		$strSqlCadastroSelect .= "cel_ddd_principal, ";
		$strSqlCadastroSelect .= "cel_principal, ";
		$strSqlCadastroSelect .= "fax_ddd_principal, ";
		$strSqlCadastroSelect .= "fax_principal, ";
		$strSqlCadastroSelect .= "site_principal, ";
		$strSqlCadastroSelect .= "n_funcionarios, ";
		$strSqlCadastroSelect .= "obs_interno, ";
		$strSqlCadastroSelect .= "id_tb_cadastro_status, ";
		//$strSqlCadastroSelect .= "id_tb_cadastro, ";
		$strSqlCadastroSelect .= "id_tb_cadastro1, ";
		$strSqlCadastroSelect .= "id_tb_cadastro2, ";
		$strSqlCadastroSelect .= "id_tb_cadastro3, ";
		$strSqlCadastroSelect .= "ativacao_destaque, ";
		$strSqlCadastroSelect .= "ativacao_mala_direta, ";
		*/
		$strSqlCadastroSelect .= "usuario, ";
		$strSqlCadastroSelect .= "senha, ";
		/*
		$strSqlCadastroSelect .= "imagem, ";
		$strSqlCadastroSelect .= "logo, ";
		$strSqlCadastroSelect .= "banner, ";
		$strSqlCadastroSelect .= "mapa, ";
		
		$strSqlCadastroSelect .= "mapa_online, ";
		$strSqlCadastroSelect .= "palavras_chave, ";
		$strSqlCadastroSelect .= "apresentacao, ";
		$strSqlCadastroSelect .= "servicos, ";
		$strSqlCadastroSelect .= "promocoes, ";
		$strSqlCadastroSelect .= "condicoes_comerciais, ";
		$strSqlCadastroSelect .= "formas_pagamento, ";
		$strSqlCadastroSelect .= "horario_atendimento, ";
		$strSqlCadastroSelect .= "situacao_atual, ";
		
		$strSqlCadastroSelect .= "informacao_complementar1, ";
		$strSqlCadastroSelect .= "informacao_complementar2, ";
		$strSqlCadastroSelect .= "informacao_complementar3, ";
		$strSqlCadastroSelect .= "informacao_complementar4, ";
		$strSqlCadastroSelect .= "informacao_complementar5, ";
		$strSqlCadastroSelect .= "informacao_complementar6, ";
		$strSqlCadastroSelect .= "informacao_complementar7, ";
		$strSqlCadastroSelect .= "informacao_complementar8, ";
		$strSqlCadastroSelect .= "informacao_complementar9, ";
		$strSqlCadastroSelect .= "informacao_complementar10, ";
		$strSqlCadastroSelect .= "informacao_complementar11, ";
		$strSqlCadastroSelect .= "informacao_complementar12, ";
		$strSqlCadastroSelect .= "informacao_complementar13, ";
		$strSqlCadastroSelect .= "informacao_complementar14, ";
		$strSqlCadastroSelect .= "informacao_complementar15, ";
		$strSqlCadastroSelect .= "informacao_complementar16, ";
		$strSqlCadastroSelect .= "informacao_complementar17, ";
		$strSqlCadastroSelect .= "informacao_complementar18, ";
		$strSqlCadastroSelect .= "informacao_complementar19, ";
		$strSqlCadastroSelect .= "informacao_complementar20, ";
		$strSqlCadastroSelect .= "informacao_complementar21, ";
		$strSqlCadastroSelect .= "informacao_complementar22, ";
		$strSqlCadastroSelect .= "informacao_complementar23, ";
		$strSqlCadastroSelect .= "informacao_complementar24, ";
		$strSqlCadastroSelect .= "informacao_complementar25, ";
		$strSqlCadastroSelect .= "informacao_complementar26, ";
		$strSqlCadastroSelect .= "informacao_complementar27, ";
		$strSqlCadastroSelect .= "informacao_complementar28, ";
		$strSqlCadastroSelect .= "informacao_complementar29, ";
		$strSqlCadastroSelect .= "informacao_complementar30, ";
		$strSqlCadastroSelect .= "informacao_complementar31, ";
		$strSqlCadastroSelect .= "informacao_complementar32, ";
		$strSqlCadastroSelect .= "informacao_complementar33, ";
		$strSqlCadastroSelect .= "informacao_complementar34, ";
		$strSqlCadastroSelect .= "informacao_complementar35, ";
		$strSqlCadastroSelect .= "informacao_complementar36, ";
		$strSqlCadastroSelect .= "informacao_complementar37, ";
		$strSqlCadastroSelect .= "informacao_complementar38, ";
		$strSqlCadastroSelect .= "informacao_complementar39, ";
		$strSqlCadastroSelect .= "informacao_complementar40, ";
		*/
		
		$strSqlCadastroSelect .= "ativacao, ";
		$strSqlCadastroSelect .= "n_visitas ";
		$strSqlCadastroSelect .= "FROM tb_cadastro ";
		$strSqlCadastroSelect .= "WHERE id <> 0 ";
		//$strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		if($email <> "")
		{
			$strSqlCadastroSelect .= "AND email_principal = :email_principal ";
		}
		if($usuario <> "")
		{
			$strSqlCadastroSelect .= "AND usuario = :usuario ";
		}
		if($_idTbCadastro <> "")
		{
			$strSqlCadastroSelect .= "AND id = :id ";
		}
		//$strSqlCadastroSelect .= "AND senha = :senhaEncrypt ";
		//$strSqlCadastroSelect .= "AND ativacao = 1 ";
		//$strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		//----------
	
	
		//Parâmetros.
		//----------
		$statementCadastroSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCadastroSelect);
		
		if ($statementCadastroSelect !== false)
		{
			
			if($email <> "")
			{
				$statementCadastroSelect->bindParam(':email_principal', $email, PDO::PARAM_STR);
			}
			if($usuario <> "")
			{
				$statementCadastroSelect->bindParam(':usuario', $usuario, PDO::PARAM_STR);
			}
			if($_idTbCadastro <> "")
			{
				$statementCadastroSelect->bindParam(':id', $_idTbCadastro, PDO::PARAM_STR);
			}
			$statementCadastroSelect->execute();
		
			/*
			$statementCadastroSelect->execute(array(
				"email_principal" => $email
			));
			*/
		}
		//----------
	
	
		//$resultadoCadastro = $dbSistemaConPDO->query($strSqlCadastroSelect);
		$resultadoCadastro = $statementCadastroSelect->fetchAll();
		
		
		if (empty($resultadoCadastro))
		{
			//echo "Nenhum registro encontrado";
			$loginVerificacao = false;
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusErro2");
		
		}else{
			
			//Loop pelos resultados.
			foreach($resultadoCadastro as $linhaCadastro)
			{
				//Verificação de key (sem criptografia).
				if($GLOBALS['configCadastroMetodoSenha'] == 0){
					if($_apiKey == $linhaCadastro['senha'])
					{
						
						$strRetorno = true;
					}
				}
				
				
				//Verificação de key (criptografia).
				if($GLOBALS['configCadastroMetodoSenha'] == 2){
					$_apiKeyDecrypt = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_apiKey, 2), 2);
					$tbCadastroSenhaDecrypt = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha'], 2), 2);
					if($_apiKeyDecrypt == $tbCadastroSenhaDecrypt)
					{
						
						$strRetorno = true;
					}
				}				
			}	
		}
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlCadastroSelect);
		unset($statementCadastroSelect);
		unset($resultadoCadastro);
		unset($linhaCadastro);
		//----------
		
		
		return $strRetorno;
	}
	//**************************************************************************************
}
?>