<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$usuario = $_POST["usuario"];
$email = $_POST["email"];
$flagCampoVazio = false;

//Verificação de campos vazios.
if($GLOBALS['habilitarCadastroUsuario'] == 1)
{
	if($usuario == "")
	{
		$flagCampoVazio = true;
	}
}else{
	if($email == "")
	{
		$flagCampoVazio = true;
	}
}

//Redirecionamento, caso algum dos campos esteja vazio.
//----------
if($flagCampoVazio == true)
{
	//Fechamento da conexão.
	$dbSistemaConPDO = null;
	
	//Montagem do URL de retorno.
	$paginaRetornoLogin = "SiteLogin.php";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusErro4");
	
	$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetornoLogin . "?" .
	"mensagemSucesso=" . $mensagemSucesso .
	"&mensagemErro=" . $mensagemErro;
	
	//Limpeza do buffer de saída.
	///*
	while (ob_get_status()) 
	{
		ob_end_clean();
	}
	//*/
	
	//Redirecionamento de página.
	//exit();
	header("Location: " . $URLRetorno);
	die();
}
//----------

$senha = $_POST["senha"];
if($configCadastroMetodoSenha == 2)
{
	$senhaEncrypt = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($senha), 2);
}

$loginVerificacao = false;
$origemLogin = $_POST["origemLogin"];

$paginaRetornoLogin = $_POST["paginaRetornoLogin"];
$idRetornoLogin = $_POST["idRetornoLogin"];

$mensagemErro = "";
$mensagemSucesso = "";


//Query de pesquisa.
//----------
$strSqlCadastroSelect = "";
$strSqlCadastroSelect .= "SELECT ";
$strSqlCadastroSelect .= "id, ";
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
$strSqlCadastroSelect .= "email_principal, ";
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
$strSqlCadastroSelect .= "ativacao, ";
$strSqlCadastroSelect .= "ativacao_destaque, ";
$strSqlCadastroSelect .= "ativacao_mala_direta, ";
$strSqlCadastroSelect .= "usuario, ";
$strSqlCadastroSelect .= "senha, ";

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
//$strSqlCadastroSelect .= "AND senha = :senhaEncrypt ";
//$strSqlCadastroSelect .= "AND ativacao = 1 ";
$strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";

$statementCadastroSelect = $dbSistemaConPDO->prepare($strSqlCadastroSelect);

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
	$statementCadastroSelect->execute();

	/*
	$statementCadastroSelect->execute(array(
		"email_principal" => $email
	));
	*/
}

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
		//Definição das variáveis de detalhes.
		$tbCadastroId = $linhaCadastro['id'];
		$tbCadastroIdCrypt = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($tbCadastroId), 2);
		
		$tbCadastroAtivacao = $linhaCadastro['ativacao'];

		if($GLOBALS['configCadastroMetodoSenha'] == 0){
			$tbCadastroSenha = $linhaCadastro['senha'];
		}
		
		if($GLOBALS['configCadastroMetodoSenha'] == 2){
			//$tbCadastroSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha'], 2), 2);
			$tbCadastroSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha'], 2), 2);
		}
		
		//echo "Nome=" . $linhaCadastro['nome'] . "<br />";
		//echo "tbCadastroId=" . $tbCadastroId . "<br />";
		//echo "tbCadastroIdCrypt=" . $tbCadastroIdCrypt . "<br />";
		//echo "EmailPrincipal=" . $linhaCadastro['email_principal'] . "<br />";
		//echo "senha=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastro['senha'], 2), 2);
		//echo "tbCadastroAtivacao=" . $tbCadastroAtivacao . "<br />";
		//echo "senha (enviada)=" . $senha . "<br />";
		//echo "senha=" . $tbCadastroSenha . "<br />";
		//echo "senha(linha)=" . $linhaCadastro['senha'] . "<br />";
		//echo "senha(teste)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura("wpPr1681jcCproVKIyoSRKlRZQAW6DyK6DdFDUip7ifUf98tTYkljZ+WEYz1XlN1uAmL5r9Fgx1f06YAjU2pHZD+G/9N6K7j2F4jujnC+g5g9sgl8WuhqSBaZgusUVsO|eKFynMCzExz5GsdqcFNg2UoaCV8hO4kUzlQ/0kK7aGE=", 2), 2) . "<br />";
		
		
		//Verificação de senha.
		//----------
		if($tbCadastroSenha == $senha)
		{
			//echo "flag01 - senha igual <br />";
			
			//Verificação de ativação.
			if($tbCadastroAtivacao == 1)
			{
				//echo "flag02";
				$loginVerificacao = true;
				
				//Definir qual tipo de usuário será criado.
				//echo "tipo cadastro = " . DbFuncoes::GetCampoGenerico04("tb_cadastro_relacao_complemento", "id_tb_cadastro_complemento", "id_tb_cadastro", $tbCadastroId, "", "", 1) . "<br />";
				$arrCadastroTipoSelecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "1", "", ",", "", "1"));
				for($countArray = 0; $countArray < count($arrCadastroTipoSelecao); $countArray++)
				{
					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroCliente'])
					{
						//echo "flag03";
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente", $tbCadastroIdCrypt);
					}
					
					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroUsuario'])
					{
						//echo "configIdCadastroUsuario";
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario", $tbCadastroIdCrypt);
					}
					
					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroUsuario2'])
					{
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario2", $tbCadastroIdCrypt);
					}
					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroUsuario3'])
					{
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario3", $tbCadastroIdCrypt);
					}
					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroUsuario4'])
					{
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario4", $tbCadastroIdCrypt);
					}
					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroUsuario5'])
					{
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario5", $tbCadastroIdCrypt);
					}

					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroUsuarioVendedor'])
					{
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioVendedor", $tbCadastroIdCrypt);
					}
					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroUsuarioRH'])
					{
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioRH", $tbCadastroIdCrypt);
					}
					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroAssinante'])
					{
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroAssinante", $tbCadastroIdCrypt);
					}
					if($arrCadastroTipoSelecao[$countArray] == $GLOBALS['configIdCadastroSimples'])
					{
						CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroSimples", $tbCadastroIdCrypt);
					}
				}
				//$cadastroTipoSelecao = DbFuncoes::FiltrosGenericosSelect03($tbCadastroId, "tb_cadastro_relacao_complemento", "id_tb_cadastro", "id_tb_cadastro_complemento", "1", "", ",", "", "1");
				//echo "cadastroTipoSelecao=" . $cadastroTipoSelecao . "<br />";
				//if(strpos($cadastroTipoSelecao, $GLOBALS['configIdCadastroCliente']) !== false)
				//if(substr_count($cadastroTipoSelecao, $GLOBALS['configIdCadastroCliente']) > 0)
				//{
					//echo "flag03";
					
				//}
				//if(substr_count($cadastroTipoSelecao, $GLOBALS['configIdCadastroUsuario']) > 0)
				//{
					//echo "configIdCadastroUsuario";
					
				//}
				//CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente", $tbCadastroIdCrypt);
				
				
				//Carrinho.
				//----------------------
				if($origemLogin == "2")
				{
					//Troca de id temporário do carrinho temporário pelo id do login.
					if(Carrinho::CarrinhoItensTotal($idTbCadastroCliente, "", "ce_itens_temporario", "", "tb_produtos", "id", "valor", "") == 0) //Verificação se já já tem itens no id logado.
					{
						//Duplicar seleção com id temporário.
						Carrinho::CarrinhoTemporarioDuplicar(Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario")), 2), 
															Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2));
																		
						
						//Verificação de erro - debug.
						//echo "flag02=" . "true" . "<br />";
					}
					
					//Verificação de erro - debug.
					//echo "flag01=" . "true" . "<br />";
					//echo "flag02=" . "true" . "<br />";
					//echo "idTbCadastroTemporario=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario")), 2) . "<br />";
					//echo "CookieValorLer_Login=" . Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login(), 2) . "<br />";
					//exit();
					

				}
				//----------------------


				$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginMensagemSucesso01");
			}else{
				$loginVerificacao = false;
				$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginMensagemErro02");
				$paginaRetornoLogin = "SiteLogin.php";
			}
		}else{
			$loginVerificacao = false;
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginMensagemErro01");
			$paginaRetornoLogin = "SiteLogin.php";
		}
		//----------
		
	}
}


//Limpeza de objetos.
//----------
unset($strSqlCadastroSelect);
unset($statementCadastroSelect);
unset($resultadoCadastro);
unset($linhaCadastro);
//----------


//Verificação de erro - debug.
/*
echo "usuario=" . $usuario . "<br />";
echo "email=" . $email . "<br />"; 
echo "senha=" . $senha . "<br />";
echo "senha=" . $senha . "<br />";
echo "senhaEncrypt=" . $senhaEncrypt . "<br />";
echo "paginaRetornoLogin=" . $paginaRetornoLogin . "<br />";
echo "idRetornoLogin=" . $idRetornoLogin . "<br />";
echo "mensagemSucesso=" . $mensagemSucesso . "<br />";
echo "mensagemErro=" . $mensagemErro . "<br />";
*/

//Fechamento da conexão.
//$dbSistemaConPDO = null;
//exit();


//Fechamento da conexão.
$dbSistemaConPDO = null;

//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetornoLogin . "?" .
"mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//Redefinição de URL de encaminhamento (caso tenha sido acessado por um link direto).
//----------
if($loginVerificacao == true)
{
	if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "URLReferenciaLogin") <> "")
	{
		$URLRetorno = $configUrlSSL . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "URLReferenciaLogin") . 
		"&mensagemSucesso=" . $mensagemSucesso .
		"&mensagemErro=" . $mensagemErro;
		
		//Limpar cookie do endereço de referencia armazenado.
		CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "URLReferenciaLogin");	
	}
}
//Verificação de erro - debug.

//echo "URLRetorno=" . $URLRetorno . "<br />";
//----------

//Limpeza do buffer de saída.
///*
while (ob_get_status()) 
{
    ob_end_clean();
}
//*/

//Redirecionamento de página.
//exit();
header("Location: " . $URLRetorno);
die();
?>