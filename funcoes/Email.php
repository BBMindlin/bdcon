<?php
class Email
{
	//Envio de e-mail.
	//**************************************************************************************
	function EnviarEmail($_emailRemetente, 
	$_emailRemetenteNome, 
	$_emailDestinatario, 
	$_emailDestinatarioNome, 
	$_emailDestinatarioCc, 
	$_emailDestinatarioNomeCc, 
	$_emailDestinatarioBcc, 
	$_emailDestinatarioNomeBcc, 
	$_emailAssunto, 
	$_emailCorpoMensagemTexto, 
	$_emailCorpoMensagemHTML, 
	$_tipoEnvio, 
	$_formatoEmail)
	{
		//_tipoEnvio: 0 - envio com o SMTP server host padrão do projeto | 1 - IP Rotativo
		$strRetorno = false;
		
		
		//Envio padrão.
		//**************************************************************************************
		if($GLOBALS['componenteEmail'] == 0)
		{
			/*
			$headers = "MIME-Version: 1.1" . $GLOBALS['configQuebraLinha'];
			$headers .= "Content-type: text/html; charset=iso-8859-1" . $GLOBALS['configQuebraLinha'];
			$headers .= "From: " . $_emailRemetente . $GLOBALS['configQuebraLinha']; // remetente
			$headers .= "Return-Path: " . $_emailRemetente . $GLOBALS['configQuebraLinha']; // return-path
			 
			$envio = mail($_emailDestinatario, $_emailAssunto, $_emailCorpoMensagemHTML, $headers); 
			
			if($envio == true)
			{
				$strRetorno = true;	
			}else
			{
				$strRetorno = "(Erro no envio de e-mail)";
			}	
			*/
			
			
			//Locaweb (linux).
			//----------
			//Montagem do cabeçalho.
			$headers = "MIME-Version: 1.1" . $GLOBALS['configQuebraLinha'];
			//$headers .= "Content-type: text/html; charset=iso-8859-1" . "\n"; //Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
			$headers .= "Content-type: text/html; charset=UTF-8" . $GLOBALS['configQuebraLinha']; //Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
			$headers .= "From: " . utf8_decode($_emailRemetente) . $GLOBALS['configQuebraLinha'];
			//$headers .= "Cc: " . $comcopia . "\n";
			//$headers .= "Bcc: " . $comcopiaoculta . "\n";
			$headers .= "Reply-To: " . utf8_decode($_emailRemetente) . $GLOBALS['configQuebraLinha'];
			
			//Se for Postfix.
			if(!mail(utf8_decode($_emailDestinatario), utf8_decode($_emailAssunto), $_emailCorpoMensagemHTML, $headers , "-r" . utf8_decode($_emailRemetente)))
			{
				//Se não for Postfix.
				$headers .= "Return-Path: " . utf8_decode($_emailRemetente) . $GLOBALS['configQuebraLinha']; 
				if(mail(utf8_decode($_emailDestinatario), utf8_decode($_emailAssunto), $_emailCorpoMensagemHTML, $headers) == true)
				{
					$strRetorno = true;
				}else{
					//$strRetorno = "(Erro no envio de e-mail)";
					$strRetorno = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus14") . " " . $_emailDestinatario;
				}
				
			}else{
				$strRetorno = true;
			}
			//----------
		}
		//**************************************************************************************


		//PHPMailer.
		//**************************************************************************************
		if($GLOBALS['componenteEmail'] == 1)
		{
			$phpMailerSender = new PHPMailer();
			$phpMailerSender->IsSMTP(); //send via SMTP
			$phpMailerSender->Host = $GLOBALS['configPHPMailerHost']; //SMTP server
			$phpMailerSender->SMTPDebug = 0; // enables SMTP debug information (for testing)
                                             // 1 = errors and messages
                                             // 2 = messages only
			$phpMailerSender->SMTPAuth = true; //turn on SMTP authentication
			//$phpMailerSender->SMTPSecure = "tls";
			if($GLOBALS['configPHPMailerUseSSL'] == true){
				$phpMailerSender->SMTPSecure = "ssl";
			}

			//$phpMailerSender->SMTP_PORT = $GLOBALS['configPHPMailerPort'];
			$phpMailerSender->Port = $GLOBALS['configPHPMailerPort'];
			
			$phpMailerSender->Username = $GLOBALS['configPHPMailerUsername']; //SMTP username
			$phpMailerSender->Password = $GLOBALS['configPHPMailerPassword']; //SMTP password
			//$phpMailerSender->From = $_emailRemetente;
			$phpMailerSender->From = Email::ValidacaoEnderecoEmail($_emailRemetente);
			
			$phpMailerSender->FromName = $_emailRemetenteNome;
			//$phpMailerSender->FromName = mb_convert_encoding($_emailRemetenteNome, "UTF-8", "auto");
			
			$phpMailerSender->AddAddress(Email::ValidacaoEnderecoEmail($_emailDestinatario),$_emailDestinatarioNome); //destinatário
			$phpMailerSender->AddReplyTo($GLOBALS['configEmailReply'],$GLOBALS['configEmailRemetenteNome']);
			//$phpMailerSender->WordWrap = 50; // set word wrap
			//$phpMailerSender->AddAttachment("Path to Attachment "); //attachment
			//$phpMailerSender->CharSet='iso-8859-1';
			$phpMailerSender->CharSet='UTF-8';
			//$phpMailerSender->IsHTML($_formatoEmail); //send as HTML
			if($_formatoEmail == 1)
			{
				$phpMailerSender->IsHTML(true); //send as HTML
				//$phpMailerSender->Body = $_emailCorpoMensagemHTML;
			}else{
				$phpMailerSender->IsHTML(false); //send as HTML
				//$phpMailerSender->Body = $_emailCorpoMensagemTexto;
			}		
			$phpMailerSender->Subject = $_emailAssunto;
			$phpMailerSender->Body = $_emailCorpoMensagemHTML;
			$phpMailerSender->AltBody = $_emailCorpoMensagemTexto;
			
			
			//Tentativa de envio de e-mail.
			//----------
			if(!$phpMailerSender->Send())
			{
				//$mensagemErro .= "(" . $phpMailerSender->ErrorInfo . ")";
				$strRetorno = "(" . $phpMailerSender->ErrorInfo . ")";
				//echo "Erro no envio de mensagem.";
				//echo "Erro do Mailer: " . $mail->ErrorInfo;
				//exit;
			}else{
				$strRetorno = true;
			}
			//----------
		}
		//**************************************************************************************
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para validar formato de e-mail.
	//**************************************************************************************
	function ValidacaoEnderecoEmail($strEmail)
	{
		$strRetorno = trim($strEmail, " \t\n\r\0\x0B");
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para montagem de conteúdo de mensagem.
	//**************************************************************************************
	function ConteudoMensagem($idTbConteudo)
	{
        //Variáveis.
        //-------------
        $mensagemErro = "";
        $mensagemSucesso = "";

        $returnConteudoMensagem = "";

        $strSqlConteudoDetalhesSelect = "";
        //-------------
		

		//Query de pesquisa.
		//----------
		$strSqlConteudoSelect = "";
		$strSqlConteudoSelect .= "SELECT ";
		$strSqlConteudoSelect .= "id, ";
		$strSqlConteudoSelect .= "n_classificacao, ";
		$strSqlConteudoSelect .= "id_tb_categorias, ";
		$strSqlConteudoSelect .= "id_tb_cadastro, ";
		$strSqlConteudoSelect .= "tipo_conteudo, ";
		$strSqlConteudoSelect .= "alinhamento_texto, ";
		$strSqlConteudoSelect .= "alinhamento_imagem, ";
		$strSqlConteudoSelect .= "conteudo, ";
		$strSqlConteudoSelect .= "conteudo_link, ";
		$strSqlConteudoSelect .= "arquivo, ";
		$strSqlConteudoSelect .= "config_arquivo, ";
		$strSqlConteudoSelect .= "dimensao_arquivo ";
		$strSqlConteudoSelect .= "FROM tb_conteudo ";
		$strSqlConteudoSelect .= "WHERE id <> 0 ";
		$strSqlConteudoSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlConteudoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoConteudo'] . " ";
		//----------
		
		
		//Parâmetros.
		//----------
		//$statementConteudoSelect = $dbSistemaConPDO->prepare($strSqlConteudoSelect);
        $statementConteudoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlConteudoSelect);

		if ($statementConteudoSelect !== false)
		{
			$statementConteudoSelect->execute(array(
				"id_tb_categorias" => $idTbConteudo
			));
		}
		//----------
		
		
		//$resultadoConteudo = $dbSistemaConPDO->query($strSqlConteudoSelect);
		$resultadoConteudo = $statementConteudoSelect->fetchAll();
		
		//Montagem do conteúdo - HTML.
		if (empty($resultadoConteudo))
		{
		
		}else{
			
			foreach($resultadoConteudo as $linhaConteudo)
			{
				$returnConteudoMensagem .= "<tr><td height='10' valign='top'>";
				
				//Título.
				if($linhaConteudo['tipo_conteudo'] == 1)
				{
					$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
					$returnConteudoMensagem .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
					$returnConteudoMensagem .= "' style='" . $GLOBALS['configNewsletterCSSConteudoTitulo'] . "'>";
					$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
					$returnConteudoMensagem .= "</div></td></tr></table>";
				}
				
				//Sub-título.
				if($linhaConteudo['tipo_conteudo'] == 2)
				{
					$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
					$returnConteudoMensagem .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
					$returnConteudoMensagem .= "' style='" . $GLOBALS['configNewsletterCSSConteudoSubtitulo'] . "'>";
					$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
					$returnConteudoMensagem .= "</div></td></tr></table>";
				}
				
				//Texto corrido.
				if($linhaConteudo['tipo_conteudo'] == 3)
				{
					$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
					$returnConteudoMensagem .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
					$returnConteudoMensagem .= "' style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
					$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
					$returnConteudoMensagem .= "</div></td></tr></table>";
				}
				
				//Tab/Recuo.
				if($linhaConteudo['tipo_conteudo'] == 4)
				{
					$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td width='30' valign='top'></td><td valign='top'><div align='left' style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
					$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
					$returnConteudoMensagem .= "</div></td></tr></table>";
				}
				
				//HTML/Tabela.
				if($linhaConteudo['tipo_conteudo'] == 7)
				{
					$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
					$returnConteudoMensagem .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
					$returnConteudoMensagem .= "' style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
					$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
					$returnConteudoMensagem .= "</div></td></tr></table>";
				}
				
				//Imagem.
				if($linhaConteudo['tipo_conteudo'] == 5)
				{
					//Alinhamento centralizado.
					if($linhaConteudo['alinhamento_imagem'] == 2)
					{
						$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='center'>";
						if($linhaConteudo['conteudo_link'] == "")
						{
							$returnConteudoMensagem .= "<img src='";
							//Método referência de URL absoluta.
							$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
							$returnConteudoMensagem .= $linhaConteudo['arquivo'];
							$returnConteudoMensagem .= "' border='0' />";
						}else{
							$returnConteudoMensagem .= "<a href='";
							$returnConteudoMensagem .= $linhaConteudo['conteudo_link'];
							$returnConteudoMensagem .= "' target='_blank'>";
							$returnConteudoMensagem .= "<img src='";
							//Método referência de URL absoluta.
							$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
							$returnConteudoMensagem .= $linhaConteudo['arquivo'];
							$returnConteudoMensagem .= "' border='0' />";
							$returnConteudoMensagem .= "</a>";
						}
						$returnConteudoMensagem .= "</div></td></tr><tr><td valign='top'><div align='center' style='" . $GLOBALS['configNewsletterCSSConteudoLegenda'] . "'>";
						$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
						$returnConteudoMensagem .= "</div></td></tr></table>";
					}
					
					//Alinhamento direita.
					if($linhaConteudo['alinhamento_imagem'] == 1)
					{
						$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
						$returnConteudoMensagem .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
						$returnConteudoMensagem .= "'><span style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
						$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
						$returnConteudoMensagem .= "</span></div></td><td width='5' valign='top'>&nbsp;</td><td width='1' valign='top'><span style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
						if($linhaConteudo['conteudo_link'] == "")
						{
							$returnConteudoMensagem .= "<img src='";
							//Método referência de URL absoluta.
							$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
							$returnConteudoMensagem .= $linhaConteudo['arquivo'];
							$returnConteudoMensagem .= "' border='0' />";
						}else{
							$returnConteudoMensagem .= "<a href='";
							$returnConteudoMensagem .= $linhaConteudo['conteudo_link'];
							$returnConteudoMensagem .= "' target='_blank'>";
							$returnConteudoMensagem .= "<img src='";
							//Método referência de URL absoluta.
							$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
							$returnConteudoMensagem .= $linhaConteudo['arquivo'];
							$returnConteudoMensagem .= "' border='0' />";
							$returnConteudoMensagem .= "</a>";
						}
						
						$returnConteudoMensagem .= "</span></td></tr><tr><td colspan='3' valign='top'><div align='center' style='" . $GLOBALS['configNewsletterCSSConteudoLegenda'] . "'></div></td></tr></table>";
					}
					
					//Alinhamento esquerda.
					if($linhaConteudo['alinhamento_imagem'] == 3)
					{
						$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td width='1' valign='top'>";
						
						if($linhaConteudo['conteudo_link'] == "")
						{
							$returnConteudoMensagem .= "<img src='";
							//Método referência de URL absoluta.
							$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
							$returnConteudoMensagem .= $linhaConteudo['arquivo'];
							$returnConteudoMensagem .= "' border='0' />";
						}else{
							$returnConteudoMensagem .= "<a href='";
							$returnConteudoMensagem .= $linhaConteudo['conteudo_link'];
							$returnConteudoMensagem .= "' target='_blank'>";
							$returnConteudoMensagem .= "<img src='";
							//Método referência de URL absoluta.
							$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
							$returnConteudoMensagem .= $linhaConteudo['arquivo'];
							$returnConteudoMensagem .= "' border='0' />";
							$returnConteudoMensagem .= "</a>";
						}
						
						$returnConteudoMensagem .= "</td><td width='5' valign='top'>&nbsp;</td><td valign='top'><div align='";
						$returnConteudoMensagem .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
						$returnConteudoMensagem .= "'><span style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
						$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
						$returnConteudoMensagem .= "</span></div></td></tr><tr><td colspan='3' valign='top'><div align='center' style='" . $GLOBALS['configNewsletterCSSConteudoLegenda'] . "'></div></td></tr></table>";
					}
				}
				
				//Imagem sem formatação.
				if($linhaConteudo['tipo_conteudo'] == 9)
				{
					$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top'><div align='center'>";
					if($linhaConteudo['conteudo_link'] == "")
					{
						$returnConteudoMensagem .= "<img src='";
						//Método referência de URL absoluta.
						$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
						$returnConteudoMensagem .= $linhaConteudo['arquivo'];
						$returnConteudoMensagem .= "' border='0' />";
					}else{
						$returnConteudoMensagem .= "<a href='";
						$returnConteudoMensagem .= $linhaConteudo['conteudo_link'];
						$returnConteudoMensagem .= "' target='_blank'>";
						$returnConteudoMensagem .= "<img src='";
						//Método referência de URL absoluta.
						$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
						$returnConteudoMensagem .= $linhaConteudo['arquivo'];
						$returnConteudoMensagem .= "' border='0' />";
						$returnConteudoMensagem .= "</a>";
					}
					$returnConteudoMensagem .= "</div></td></tr></table>";
				}
				
				//Arquivo.
				if($linhaConteudo['tipo_conteudo'] == 9)
				{
					if($linhaConteudo['config_arquivo'] == 3)
					{
						$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
						$returnConteudoMensagem .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
						$returnConteudoMensagem .= "'><a href='";
						$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/ConteudoDownloadExe.php?id=";
						$returnConteudoMensagem .= $linhaConteudo['id'];
						$returnConteudoMensagem .= "&nome_video=";
						$returnConteudoMensagem .= $linhaConteudo['arquivo'];
						$returnConteudoMensagem .= "' style='" . $GLOBALS['configNewsletterCSSConteudoLinks'] . "'>";
						$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
						$returnConteudoMensagem .= "</a></div></td>";
						$returnConteudoMensagem .= "</tr>";
						$returnConteudoMensagem .= "</table>";
					}else if($linhaConteudo['config_arquivo'] == 4)
					{
						$returnConteudoMensagem .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
						$returnConteudoMensagem .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
						$returnConteudoMensagem .= "'><a href='";
						$returnConteudoMensagem .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
						$returnConteudoMensagem .= $linhaConteudo['arquivo'];
						$returnConteudoMensagem .= "' target='_blank' style='" . $GLOBALS['configNewsletterCSSConteudoLinks'] . "'>";
						$returnConteudoMensagem .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
						$returnConteudoMensagem .= "</a></div></td></tr></table>";
					}
				}
				$returnConteudoMensagem .= "</td></tr>";
			}
			//$returnConteudoMensagem .= "</table></td></tr></table>";
		}
		
		//Limpeza de objetos.
		//----------
		unset($strSqlConteudoSelect);
		unset($statementConteudoSelect);
		unset($resultadoConteudo);
		unset($linhaConteudo);
		//----------


		return $returnConteudoMensagem;
	}
	//**************************************************************************************
	
	
	//Função para montagem de conteúdo de especificamente para envio de newsletter.
	//**************************************************************************************
	function ConteudoNewsletter01($idItem, 
	$tipoConteudo, 
	$formatoEmail, 
	$strConfiguracaoEspecial = "")
	{
        //tipoConteudo: 1 - Conteúdo | 301 - Cabeçalho (tabela HTML) | 302 - Rodapé (tabela HTML) | 303 - Desativação de Cadastro
        //formatoEmail: 0 - texto | 1 - HTML
		
		
        //Variáveis.
        //-------------
        $strRetorno = "";
        $mensagemErro = "";
        $mensagemSucesso = "";
        //-------------
		
		
		//Conteúdo.
		//----------
		if($tipoConteudo == 1)
		{
			//Query de pesquisa.
			//----------
			$strSqlConteudoSelect = "";
			$strSqlConteudoSelect .= "SELECT ";
			$strSqlConteudoSelect .= "id, ";
			$strSqlConteudoSelect .= "n_classificacao, ";
			$strSqlConteudoSelect .= "id_tb_categorias, ";
			$strSqlConteudoSelect .= "id_tb_cadastro, ";
			$strSqlConteudoSelect .= "tipo_conteudo, ";
			$strSqlConteudoSelect .= "alinhamento_texto, ";
			$strSqlConteudoSelect .= "alinhamento_imagem, ";
			$strSqlConteudoSelect .= "conteudo, ";
			$strSqlConteudoSelect .= "conteudo_link, ";
			$strSqlConteudoSelect .= "arquivo, ";
			$strSqlConteudoSelect .= "config_arquivo, ";
			$strSqlConteudoSelect .= "dimensao_arquivo ";
			$strSqlConteudoSelect .= "FROM tb_conteudo ";
			$strSqlConteudoSelect .= "WHERE id <> 0 ";
			$strSqlConteudoSelect .= "AND id_tb_categorias = :id_tb_categorias ";
			$strSqlConteudoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoConteudo'] . " ";
			//----------
			
			
			//Parâmetros.
			//----------
			//$statementConteudoSelect = $dbSistemaConPDO->prepare($strSqlConteudoSelect);
			$statementConteudoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlConteudoSelect);
	
			if ($statementConteudoSelect !== false)
			{
				$statementConteudoSelect->execute(array(
					"id_tb_categorias" => $idItem
				));
			}
			//----------
			
			
			//$resultadoConteudo = $dbSistemaConPDO->query($strSqlConteudoSelect);
			$resultadoConteudo = $statementConteudoSelect->fetchAll();
			
			//Montagem do conteúdo.
			if (empty($resultadoConteudo))
			{
			
			}else{
				
				foreach($resultadoConteudo as $linhaConteudo)
				{
					
					//HTML.
					//----------
					if($formatoEmail == 1)
					{
						$strRetorno .= "<tr><td height='10' valign='top'>";
						
						//Título.
						if($linhaConteudo['tipo_conteudo'] == 1)
						{
							$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
							$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
							$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoTitulo'] . "'>";
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							$strRetorno .= "</div></td></tr></table>";
						}
						
						//Sub-título.
						if($linhaConteudo['tipo_conteudo'] == 2)
						{
							$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
							$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
							$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoSubtitulo'] . "'>";
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							$strRetorno .= "</div></td></tr></table>";
						}
						
						//Texto corrido.
						if($linhaConteudo['tipo_conteudo'] == 3)
						{
							$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
							$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
							$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							$strRetorno .= "</div></td></tr></table>";
						}
						
						//Tab/Recuo.
						if($linhaConteudo['tipo_conteudo'] == 4)
						{
							$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td width='30' valign='top'></td><td valign='top'><div align='left' style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							$strRetorno .= "</div></td></tr></table>";
						}
						
						//HTML/Tabela.
						if($linhaConteudo['tipo_conteudo'] == 7)
						{
							$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
							$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
							$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							$strRetorno .= "</div></td></tr></table>";
						}
						
						//Imagem.
						if($linhaConteudo['tipo_conteudo'] == 5)
						{
							//Alinhamento centralizado.
							if($linhaConteudo['alinhamento_imagem'] == 2)
							{
								$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='center'>";
								if($linhaConteudo['conteudo_link'] == "")
								{
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
								}else{
									$strRetorno .= "<a href='";
									$strRetorno .= $linhaConteudo['conteudo_link'];
									$strRetorno .= "' target='_blank'>";
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
									$strRetorno .= "</a>";
								}
								$strRetorno .= "</div></td></tr><tr><td valign='top'><div align='center' style='" . $GLOBALS['configNewsletterCSSConteudoLegenda'] . "'>";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								$strRetorno .= "</div></td></tr></table>";
							}
							
							//Alinhamento direita.
							if($linhaConteudo['alinhamento_imagem'] == 1)
							{
								$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
								$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
								$strRetorno .= "'><span style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								$strRetorno .= "</span></div></td><td width='5' valign='top'>&nbsp;</td><td width='1' valign='top'><span style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
								if($linhaConteudo['conteudo_link'] == "")
								{
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
								}else{
									$strRetorno .= "<a href='";
									$strRetorno .= $linhaConteudo['conteudo_link'];
									$strRetorno .= "' target='_blank'>";
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
									$strRetorno .= "</a>";
								}
								
								$strRetorno .= "</span></td></tr><tr><td colspan='3' valign='top'><div align='center' style='" . $GLOBALS['configNewsletterCSSConteudoLegenda'] . "'></div></td></tr></table>";
							}
							
							//Alinhamento esquerda.
							if($linhaConteudo['alinhamento_imagem'] == 3)
							{
								$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td width='1' valign='top'>";
								
								if($linhaConteudo['conteudo_link'] == "")
								{
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
								}else{
									$strRetorno .= "<a href='";
									$strRetorno .= $linhaConteudo['conteudo_link'];
									$strRetorno .= "' target='_blank'>";
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
									$strRetorno .= "</a>";
								}
								
								$strRetorno .= "</td><td width='5' valign='top'>&nbsp;</td><td valign='top'><div align='";
								$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
								$strRetorno .= "'><span style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								$strRetorno .= "</span></div></td></tr><tr><td colspan='3' valign='top'><div align='center' style='" . $GLOBALS['configNewsletterCSSConteudoLegenda'] . "'></div></td></tr></table>";
							}
						}
						
						//Imagem sem formatação.
						if($linhaConteudo['tipo_conteudo'] == 9)
						{
							$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top'><div align='center'>";
							if($linhaConteudo['conteudo_link'] == "")
							{
								$strRetorno .= "<img src='";
								//Método referência de URL absoluta.
								$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
								$strRetorno .= $linhaConteudo['arquivo'];
								$strRetorno .= "' border='0' />";
							}else{
								$strRetorno .= "<a href='";
								$strRetorno .= $linhaConteudo['conteudo_link'];
								$strRetorno .= "' target='_blank'>";
								$strRetorno .= "<img src='";
								//Método referência de URL absoluta.
								$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
								$strRetorno .= $linhaConteudo['arquivo'];
								$strRetorno .= "' border='0' />";
								$strRetorno .= "</a>";
							}
							$strRetorno .= "</div></td></tr></table>";
						}
						
						//Arquivo.
						if($linhaConteudo['tipo_conteudo'] == 9)
						{
							if($linhaConteudo['config_arquivo'] == 3)
							{
								$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
								$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
								$strRetorno .= "'><a href='";
								$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/ConteudoDownloadExe.php?id=";
								$strRetorno .= $linhaConteudo['id'];
								$strRetorno .= "&nome_video=";
								$strRetorno .= $linhaConteudo['arquivo'];
								$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoLinks'] . "'>";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
		
								$strRetorno .= "</a></div></td>";
								$strRetorno .= "</tr>";
								$strRetorno .= "</table>";
							}else if($linhaConteudo['config_arquivo'] == 4)
							{
								$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
								$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
								$strRetorno .= "'><a href='";
								$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
								$strRetorno .= $linhaConteudo['arquivo'];
								$strRetorno .= "' target='_blank' style='" . $GLOBALS['configNewsletterCSSConteudoLinks'] . "'>";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								$strRetorno .= "</a></div></td></tr></table>";
							}
						}
						$strRetorno .= "</td></tr>";
					}
					//----------
					
					
					//Texto.
					//----------
					if($formatoEmail == 0)
					{
						//$strRetorno .= "<tr><td height='10' valign='top'>";
						
						//Título.
						if($linhaConteudo['tipo_conteudo'] == 1)
						{
							//$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
							//$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
							//$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoTitulo'] . "'>";
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							$strRetorno .= $GLOBALS['configQuebraLinha'];
							//$strRetorno .= "</div></td></tr></table>";
						}
						
						//Sub-título.
						if($linhaConteudo['tipo_conteudo'] == 2)
						{
							//$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
							//$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
							//$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoSubtitulo'] . "'>";
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							$strRetorno .= $GLOBALS['configQuebraLinha'];
							//$strRetorno .= "</div></td></tr></table>";
						}
						
						//Texto corrido.
						if($linhaConteudo['tipo_conteudo'] == 3)
						{
							//$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
							//$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
							//$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							$strRetorno .= $GLOBALS['configQuebraLinha'];
							//$strRetorno .= "</div></td></tr></table>";
						}
						
						//Tab/Recuo.
						if($linhaConteudo['tipo_conteudo'] == 4)
						{
							//$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td width='30' valign='top'></td><td valign='top'><div align='left' style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							$strRetorno .= $GLOBALS['configQuebraLinha'];
							//$strRetorno .= "</div></td></tr></table>";
						}
						
						//HTML/Tabela.
						if($linhaConteudo['tipo_conteudo'] == 7)
						{
							//$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
							//$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
							//$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
							//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
							//$strRetorno .= "</div></td></tr></table>";
						}
						
						//Imagem.
						if($linhaConteudo['tipo_conteudo'] == 5)
						{
							/*
							//Alinhamento centralizado.
							if($linhaConteudo['alinhamento_imagem'] == 2)
							{
								$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='center'>";
								if($linhaConteudo['conteudo_link'] == "")
								{
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
								}else{
									$strRetorno .= "<a href='";
									$strRetorno .= $linhaConteudo['conteudo_link'];
									$strRetorno .= "' target='_blank'>";
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
									$strRetorno .= "</a>";
								}
								$strRetorno .= "</div></td></tr><tr><td valign='top'><div align='center' style='" . $GLOBALS['configNewsletterCSSConteudoLegenda'] . "'>";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								$strRetorno .= "</div></td></tr></table>";
							}
							
							//Alinhamento direita.
							if($linhaConteudo['alinhamento_imagem'] == 1)
							{
								$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
								$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
								$strRetorno .= "'><span style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								$strRetorno .= "</span></div></td><td width='5' valign='top'>&nbsp;</td><td width='1' valign='top'><span style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
								if($linhaConteudo['conteudo_link'] == "")
								{
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
								}else{
									$strRetorno .= "<a href='";
									$strRetorno .= $linhaConteudo['conteudo_link'];
									$strRetorno .= "' target='_blank'>";
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
									$strRetorno .= "</a>";
								}
								
								$strRetorno .= "</span></td></tr><tr><td colspan='3' valign='top'><div align='center' style='" . $GLOBALS['configNewsletterCSSConteudoLegenda'] . "'></div></td></tr></table>";
							}
							
							//Alinhamento esquerda.
							if($linhaConteudo['alinhamento_imagem'] == 3)
							{
								$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td width='1' valign='top'>";
								
								if($linhaConteudo['conteudo_link'] == "")
								{
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
								}else{
									$strRetorno .= "<a href='";
									$strRetorno .= $linhaConteudo['conteudo_link'];
									$strRetorno .= "' target='_blank'>";
									$strRetorno .= "<img src='";
									//Método referência de URL absoluta.
									$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/r";
									$strRetorno .= $linhaConteudo['arquivo'];
									$strRetorno .= "' border='0' />";
									$strRetorno .= "</a>";
								}
								
								$strRetorno .= "</td><td width='5' valign='top'>&nbsp;</td><td valign='top'><div align='";
								$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
								$strRetorno .= "'><span style='" . $GLOBALS['configNewsletterCSSConteudoTextoCorrido'] . "'>";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								$strRetorno .= "</span></div></td></tr><tr><td colspan='3' valign='top'><div align='center' style='" . $GLOBALS['configNewsletterCSSConteudoLegenda'] . "'></div></td></tr></table>";
							}
							*/
						}
						
						//Imagem sem formatação.
						if($linhaConteudo['tipo_conteudo'] == 9)
						{
							/*
							$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top'><div align='center'>";
							if($linhaConteudo['conteudo_link'] == "")
							{
								$strRetorno .= "<img src='";
								//Método referência de URL absoluta.
								$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
								$strRetorno .= $linhaConteudo['arquivo'];
								$strRetorno .= "' border='0' />";
							}else{
								$strRetorno .= "<a href='";
								$strRetorno .= $linhaConteudo['conteudo_link'];
								$strRetorno .= "' target='_blank'>";
								$strRetorno .= "<img src='";
								//Método referência de URL absoluta.
								$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
								$strRetorno .= $linhaConteudo['arquivo'];
								$strRetorno .= "' border='0' />";
								$strRetorno .= "</a>";
							}
							$strRetorno .= "</div></td></tr></table>";
							*/
						}
						
						//Arquivo.
						if($linhaConteudo['tipo_conteudo'] == 9)
						{
							if($linhaConteudo['config_arquivo'] == 3)
							{
								//$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
								//$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
								//$strRetorno .= "'><a href='";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								$strRetorno .= $GLOBALS['configQuebraLinha'];
								$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/ConteudoDownloadExe.php?id=";
								$strRetorno .= $linhaConteudo['id'];
								$strRetorno .= "&nome_video=";
								$strRetorno .= $linhaConteudo['arquivo'];
								$strRetorno .= $GLOBALS['configQuebraLinha'];
								//$strRetorno .= "' style='" . $GLOBALS['configNewsletterCSSConteudoLinks'] . "'>";
								//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
		
								//$strRetorno .= "</a></div></td>";
								//$strRetorno .= "</tr>";
								//$strRetorno .= "</table>";
							}else if($linhaConteudo['config_arquivo'] == 4)
							{
								//$strRetorno .= "<table width='100%' border='0' cellpadding='0' cellspacing='4'><tr><td valign='top'><div align='";
								//$strRetorno .= Funcoes::AlinhamentoTexto($linhaConteudo['alinhamento_texto']);
								//$strRetorno .= "'><a href='";
								$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								$strRetorno .= $GLOBALS['configQuebraLinha'];
								$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivosVisualizacao'] . "/";
								$strRetorno .= $linhaConteudo['arquivo'];
								$strRetorno .= $GLOBALS['configQuebraLinha'];
								//$strRetorno .= "' target='_blank' style='" . $GLOBALS['configNewsletterCSSConteudoLinks'] . "'>";
								//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaConteudo['conteudo']);
								//$strRetorno .= "</a></div></td></tr></table>";
								
								
							}
						}
						//$strRetorno .= "</td></tr>";
					}
				}
				//$returnConteudoMensagem .= "</table></td></tr></table>";
				
			}
			
			//Limpeza de objetos.
			//----------
			unset($strSqlConteudoSelect);
			unset($statementConteudoSelect);
			unset($resultadoConteudo);
			unset($linhaConteudo);
			//----------
		}
		//----------
		
		
		//Cabeçalho.
		//----------
		if($tipoConteudo == 301)
		{
			//HTML.
			if($formatoEmail == 1)
			{
				//$strRetorno .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'><html><head><meta http-equiv='content-type' content='text/html; charset=iso-8859-1'><title>";
				$strRetorno .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html><head><meta http-equiv='content-type' content='text/html; charset=iso-8859-1'><title>";
				$strRetorno .= DbFuncoes::GetCampoGenerico01($idItem, "tb_newsletter", "assunto");
				//$strRetorno .= $tbNewsletterAssunto;
				$strRetorno .= "</title>";
				//Criar rotina para imprimir os dados da folha de estilos.
				//$strRetorno .= "<link href='";
				//$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['visualizacaoAtivaSistema'];
				//$strRetorno .= "/EstilosSite.css' rel='stylesheet' type='text/css'>";
				$strRetorno .= "</head><body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'><table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='";
				$strRetorno .= DbFuncoes::GetCampoGenerico01($idItem, "tb_newsletter", "cor_fundo");
				//$strRetorno .= $tbNewsletterCorFundo;
				$strRetorno .= "'><tr><td align='center' valign='top'><table width='";
				$strRetorno .= DbFuncoes::GetCampoGenerico01($idItem, "tb_newsletter", "largura");
				//$strRetorno .= $tbNewsletterLargura;
				$strRetorno .= "' border='";
				if(DbFuncoes::GetCampoGenerico01($idItem, "tb_newsletter", "cor_borda") == "")
				//if($tbNewsletterCorBorda == "")
				{
					$strRetorno .= "0";
				}else{
					$strRetorno .= "1";
				}
				$strRetorno .= "' cellpadding='0' cellspacing='0' bordercolor='";
				$strRetorno .= DbFuncoes::GetCampoGenerico01($idItem, "tb_newsletter", "cor_borda");
				//$strRetorno .= $tbNewsletterCorBorda;
				$strRetorno .= "' bgcolor='";
				$strRetorno .= DbFuncoes::GetCampoGenerico01($idItem, "tb_newsletter", "cor_interna");
				//$strRetorno .= $tbNewsletterCorInterna;
				$strRetorno .= "'><tr><td valign='top'><table width='100%' border='0' cellpadding='0' cellspacing='0'>";
				
				//Conteúdo da newsletter.
				//$conteudoHTML .= Email::ConteudoMensagem($idTbNewsletter);
			}
			
			
			//Texto.
			if($formatoEmail == 0)
			{
			}
		}
		//----------
		
		
		//Rodapé.
		//----------
		if($tipoConteudo == 302)
		{
			if($formatoEmail == 1)
			{
				$strRetorno .= "</table></td></tr></table>";
				
				$strRetorno .= "<a href='";
				$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['visualizacaoAtivaSistema'];
				$strRetorno .= "/SiteNewsletterDesativarExe.php?idTbRegistro=";
				//$strRetorno .= $arrEmailDestinatarioId[i].ToString();
				$strRetorno .= $idItem;
				$strRetorno .= "' target='_blank' style='" . $GLOBALS['configNewsletterCSSConteudoLinks'] . "'>";
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterLinkDesativar");
				$strRetorno .= "</a><br />";
				
				$strRetorno .= "</td></tr></table></body></html>";
			}
			
			//Texto.
			if($formatoEmail == 0)
			{
				$strRetorno .= $GLOBALS['configQuebraLinha'];
				$strRetorno .= $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterLinkDesativar");
				
				//$strRetorno .= "<a href='";
				$strRetorno .= $GLOBALS['configUrl'] . "/" . $GLOBALS['visualizacaoAtivaSistema'];
				$strRetorno .= "/SiteNewsletterDesativarExe.php?idTbRegistro=";
				//$strRetorno .= $arrEmailDestinatarioId[i].ToString();
				$strRetorno .= $idItem;
				//$strRetorno .= "' target='_blank' style='" . $GLOBALS['configNewsletterCSSConteudoLinks'] . "'>";
				//$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterLinkDesativar");
				//$strRetorno .= "</a><br />";
				
				//$strRetorno .= "</td></tr></table></body></html>";
			}
		}
		//----------


		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para enviar pedidos.
	//**************************************************************************************
	function PedidosEnviar($_idCePedidos, 
	$emailDestinatario, 
	$nomeDestinatario, 
	$origemEnvio)
	{
		//origemEnvio: 0 - sistema | 1 - site
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = false;
		$corpoMensagemHTML = "";
		$emailAssunto = "";
		//----------
		
		
		if($origemEnvio == 0)
		{
			$emailAssunto = $GLOBALS['configNomeCliente'] . " - " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosNumero") . ": " . $_idCePedidos;
		}
		if($origemEnvio == 1)
		{
			$emailAssunto = $GLOBALS['configNomeCliente'] . " - " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosNumero") . ": " . $_idCePedidos;
		}
		
		
		//Montagem do conteúdo (HTML).
		//----------
		$corpoMensagemHTML .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosInformacoesCliente") . ":" . $GLOBALS['configQuebraLinha'];
		$corpoMensagemHTML .= Email::CadastroConteudo(DbFuncoes::GetCampoGenerico01($_idCePedidos, "ce_pedidos", "id_tb_cadastro_cliente"), 1, 0, 1);
		$corpoMensagemHTML .= $GLOBALS['configQuebraLinha'];
		$corpoMensagemHTML .= $GLOBALS['configQuebraLinha'];
		$corpoMensagemHTML .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosInformacoes") . ":" . $GLOBALS['configQuebraLinha'];
		$corpoMensagemHTML .= Email::PedidosConteudo($_idCePedidos, 1, 0);
		$corpoMensagemHTML .= $GLOBALS['configQuebraLinha'];
		$corpoMensagemHTML .= $GLOBALS['configQuebraLinha'];
		$corpoMensagemHTML .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosListagemItens") . ":" . $GLOBALS['configQuebraLinha'];
		$corpoMensagemHTML .= Email::PedidosItensConteudo($_idCePedidos, 1, 0);
		//----------
		
		if(Email::EnviarEmail($GLOBALS['configEmailRemetente'], 
								utf8_encode($GLOBALS['configEmailRemetenteNome']), 
								$emailDestinatario, 
								$nomeDestinatario, 
								"", 
								"", 
								"", 
								"", 
								$emailAssunto, 
								"", 
								$corpoMensagemHTML, 
								0, 
								$GLOBALS['configFormatoEmail']) == true)
								{
									$strRetorno = true;
								}
							
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para montar conteúdo de itens do pedido.
	//**************************************************************************************
	function PedidosItensConteudo($_idCePedidos, $formatoEmail, $origemEnvio)
	{
		//formatoEmail: 0 - texto | 1 - HTML
		//origemEnvio: 0 - sistema | 1 - site
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = "";
		$strSqlPedidosItensSelect = "";
		$countItens = 1;
		//----------
		
		
        //Query de pesquisa.
        //----------
        $strSqlPedidosItensSelect = "";
        $strSqlPedidosItensSelect .= "SELECT ";
        //$strSqlPedidosItensSelect .= "* ";
        $strSqlPedidosItensSelect .= "id, ";
        $strSqlPedidosItensSelect .= "id_ce_pedidos, ";
        $strSqlPedidosItensSelect .= "id_tb_cadastro_cliente, ";
        $strSqlPedidosItensSelect .= "id_tb_cadastro_usuario, ";
        $strSqlPedidosItensSelect .= "id_item, ";
        $strSqlPedidosItensSelect .= "cod_item, ";
        $strSqlPedidosItensSelect .= "descricao, ";
        $strSqlPedidosItensSelect .= "tabela, ";
        $strSqlPedidosItensSelect .= "quantidade, ";
        $strSqlPedidosItensSelect .= "valor_unitario, ";
        $strSqlPedidosItensSelect .= "id_tb_itens_valores, ";
        $strSqlPedidosItensSelect .= "id_tb_itens_valores_titulo, ";
        $strSqlPedidosItensSelect .= "id_tb_itens_data, ";
        $strSqlPedidosItensSelect .= "valor_total, ";
        $strSqlPedidosItensSelect .= "ids_opcionais, ";
        $strSqlPedidosItensSelect .= "ids_opcionais_descricao, ";
        $strSqlPedidosItensSelect .= "obs, ";
        
        $strSqlPedidosItensSelect .= "informacao_complementar1, ";
        $strSqlPedidosItensSelect .= "informacao_complementar2, ";
        $strSqlPedidosItensSelect .= "informacao_complementar3, ";
        $strSqlPedidosItensSelect .= "informacao_complementar4, ";
        $strSqlPedidosItensSelect .= "informacao_complementar5, ";
        
        $strSqlPedidosItensSelect .= "ativacao, ";
        $strSqlPedidosItensSelect .= "data_pedido, ";
        $strSqlPedidosItensSelect .= "data_pagamento, ";
        $strSqlPedidosItensSelect .= "data_entrega, ";
        $strSqlPedidosItensSelect .= "data_validade, ";
        $strSqlPedidosItensSelect .= "id_tb_produtos_complemento_status ";
        
        $strSqlPedidosItensSelect .= "FROM ce_itens ";
        $strSqlPedidosItensSelect .= "WHERE id <> 0 ";
        if($_idCePedidos <> "")
        {
            $strSqlPedidosItensSelect .= "AND id_ce_pedidos = :id_ce_pedidos ";
        }
        
        //$strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidosItens'] . " ";
        //if($GLOBALS['habilitarPedidosItensClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) <> "")
        //{
            //$strSqlPedidosItensSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) . " ";
            
        //}else{
            $strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoItens'] . " ";
        //}
		//----------

		
		//Parâmetros.
		//----------
        $statementPedidosItensSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlPedidosItensSelect);
        
        if ($statementPedidosItensSelect !== false)
        {
            if($_idCePedidos <> "")
            {
                $statementPedidosItensSelect->bindParam(':id_ce_pedidos', $_idCePedidos, PDO::PARAM_STR);
            }
            $statementPedidosItensSelect->execute();
            
            /*
            $statementPedidosItensSelect->execute(array(
                "id_parent" => $idParentPedidosItens
            ));
            */
        }
		//----------


        //$resultadoPedidosItens = $dbSistemaConPDO->query($strSqlPedidosItensSelect);
        $resultadoPedidosItens = $statementPedidosItensSelect->fetchAll();


		//Formato HTML.
        //----------
		if($formatoEmail == 1)
		{
			//Loop pelos resultados.
			foreach($resultadoPedidosItens as $linhaPedidosItens)
			{
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensItem") . ": " . $countItens . $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensCodigo") . ": " . $linhaPedidosItens['id_item'] . $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensDescricao") . ": " . $linhaPedidosItens['descricao'] . $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensQuantidade") . ": " . $linhaPedidosItens['quantidade'] . $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensValorUnitario") . ": " . $GLOBALS['configSistemaMoeda'] . " " . Funcoes::MascaraValorLer($linhaPedidosItens['valor_unitario'], $GLOBALS['configSistemaMoeda']) . $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosItensValorTotal") . ": " . $GLOBALS['configSistemaMoeda'] . " " . Funcoes::MascaraValorLer($linhaPedidosItens['valor_total'], $GLOBALS['configSistemaMoeda']) . $GLOBALS['configQuebraLinha'];
				$strRetorno .= $GLOBALS['configQuebraLinha'];
				$countItens = $countItens + 1;
			}
		}
        //----------


        //Limpeza de objetos.
        //----------
        unset($strSqlPedidosItensSelect);
        unset($statementPedidosItensSelect);
        unset($resultadoPedidosItens);
        unset($linhaPedidosItens);
        //----------	
		
		
		return $strRetorno;	
	}
	//**************************************************************************************
	
	
	//Função para montar conteúdo do pedido.
	//**************************************************************************************
	function PedidosConteudo($_idCePedidos, $formatoEmail, $origemEnvio)
	{
		//formatoEmail: 0 - texto | 1 - HTML
		//origemEnvio: 0 - sistema | 1 - site
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = "";
		$strSqlPedidosDetalhesSelect = "";
		//----------
		
		
		//Query de pesquisa.
		//----------
		$strSqlPedidosDetalhesSelect = "";
		$strSqlPedidosDetalhesSelect .= "SELECT ";
		//$strSqlPedidosDetalhesSelect .= "* ";
		$strSqlPedidosDetalhesSelect .= "id, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_cliente, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_enderecos, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_cartoes, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_usuario, ";
		$strSqlPedidosDetalhesSelect .= "tipo_pagamento, ";
		$strSqlPedidosDetalhesSelect .= "data_pedido, ";
		$strSqlPedidosDetalhesSelect .= "data_pagamento, ";
		$strSqlPedidosDetalhesSelect .= "data_entrega, ";
		$strSqlPedidosDetalhesSelect .= "data_validade, ";
		$strSqlPedidosDetalhesSelect .= "valor_pedido, ";
		$strSqlPedidosDetalhesSelect .= "valor_frete, ";
		$strSqlPedidosDetalhesSelect .= "periodo_contratacao, ";
		$strSqlPedidosDetalhesSelect .= "tipo_entrega, ";
		$strSqlPedidosDetalhesSelect .= "valor_total, ";
		$strSqlPedidosDetalhesSelect .= "peso_total, ";
		$strSqlPedidosDetalhesSelect .= "endereco_entrega, ";
		$strSqlPedidosDetalhesSelect .= "endereco_numero_entrega, ";
		$strSqlPedidosDetalhesSelect .= "endereco_complemento_entrega, ";
		$strSqlPedidosDetalhesSelect .= "bairro_entrega, ";
		$strSqlPedidosDetalhesSelect .= "cidade_entrega, ";
		$strSqlPedidosDetalhesSelect .= "cidade_entrega, ";
		$strSqlPedidosDetalhesSelect .= "pais_entrega, ";
		$strSqlPedidosDetalhesSelect .= "cep_entrega, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro1, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro2, ";
		$strSqlPedidosDetalhesSelect .= "id_tb_cadastro3, ";
		$strSqlPedidosDetalhesSelect .= "obs, ";
		$strSqlPedidosDetalhesSelect .= "ativacao, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar1, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar2, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar3, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar4, ";
		$strSqlPedidosDetalhesSelect .= "informacao_complementar5, ";
		$strSqlPedidosDetalhesSelect .= "id_ce_complemento_status, ";
		$strSqlPedidosDetalhesSelect .= "transacao_externa_status, ";
		$strSqlPedidosDetalhesSelect .= "transacao_externa_autenticacao, ";
		$strSqlPedidosDetalhesSelect .= "transacao_externa_log, ";
		$strSqlPedidosDetalhesSelect .= "transacao_externa_data_pagamento_liberado ";
		$strSqlPedidosDetalhesSelect .= "FROM ce_pedidos ";
		$strSqlPedidosDetalhesSelect .= "WHERE id <> 0 ";
		//$strSqlPedidosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlPedidosDetalhesSelect .= "AND id = :id ";
		//$strSqlPedidosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		//echo "strSqlPedidosDetalhesSelect=" . $strSqlPedidosDetalhesSelect . "<br>";
		//----------
		
		
		//Parâmetros.
		//----------
		$statementPedidosDetalhesSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlPedidosDetalhesSelect);
		
		if ($statementPedidosDetalhesSelect !== false)
		{
			$statementPedidosDetalhesSelect->execute(array(
				"id" => $_idCePedidos
			));
		}
		//----------
		
		
		//$resultadoPedidosDetalhes = $dbSistemaConPDO->query($strSqlPedidosDetalhesSelect);
		$resultadoPedidosDetalhes = $statementPedidosDetalhesSelect->fetchAll();
		
		
		//Formato HTML.
        //----------
		if($formatoEmail == 1)
		{
			foreach($resultadoPedidosDetalhes as $linhaPedidosDetalhes)
			{
				//Dados do Pedido.
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosNumero") . ": " . $linhaPedidosDetalhes['id'] . $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosData") . ": " . Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pedido'], $GLOBALS['configSistemaFormatoData'], "1") . $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosValorPedido") . ": " . $GLOBALS['configSistemaMoeda'] . " " . Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_pedido'], $GLOBALS['configSistemaMoeda']) . $GLOBALS['configQuebraLinha'];
				if($linhaPedidosItens['valor_frete'] <> "0")
				{
					$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosValorFrete") . ": " . $GLOBALS['configSistemaMoeda'] . " ". Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_frete'], $GLOBALS['configSistemaMoeda']) . $GLOBALS['configQuebraLinha'];
				}
				
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosValorTotal") . ": " . $GLOBALS['configSistemaMoeda'] . " ". Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_frete'], $GLOBALS['configSistemaMoeda']) . $GLOBALS['configQuebraLinha'];
				$strRetorno .= $GLOBALS['configQuebraLinha'];
				$strRetorno .= $GLOBALS['configQuebraLinha'];
			}
		}
		//----------

		
		//Limpeza de objetos.
		//----------
		unset($strSqlPedidosDetalhesSelect);
		unset($statementPedidosDetalhesSelect);
		unset($resultadoPedidosDetalhes);
		unset($linhaPedidosDetalhes);
		//----------
		
		
		return $strRetorno;
	}
	//**************************************************************************************


	//Função para montar conteúdo do cadastro.
	//**************************************************************************************
	function CadastroConteudo($_idTbCadastro, 
	$formatoEmail, 
	$origemEnvio, 
	$finalidadeConteudo)
	{
		//formatoEmail: 0 - texto | 1 - HTML
		//origemEnvio: 0 - sistema | 1 - site
		//finalidadeConteudo: 1 - pedidos (cliente)
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = "";
		$strSqlCadastroDetalhesSelect = "";
		//----------
		
		
		//Query de pesquisa.
		//----------
		$strSqlCadastroDetalhesSelect = "";
		$strSqlCadastroDetalhesSelect .= "SELECT ";
		$strSqlCadastroDetalhesSelect .= "id, ";
		$strSqlCadastroDetalhesSelect .= "id_tb_categorias, ";
		//$strSqlCadastroDetalhesSelect .= "id_parent_cadastro, ";
		$strSqlCadastroDetalhesSelect .= "data_cadastro, ";
		$strSqlCadastroDetalhesSelect .= "pf_pj, ";
		$strSqlCadastroDetalhesSelect .= "nome, ";
		$strSqlCadastroDetalhesSelect .= "sexo, ";
		$strSqlCadastroDetalhesSelect .= "altura, ";
		$strSqlCadastroDetalhesSelect .= "peso, ";
		$strSqlCadastroDetalhesSelect .= "razao_social, ";
		$strSqlCadastroDetalhesSelect .= "nome_fantasia, ";
		
		$strSqlCadastroDetalhesSelect .= "data_nascimento, ";
		$strSqlCadastroDetalhesSelect .= "data1, ";
		$strSqlCadastroDetalhesSelect .= "data2, ";
		$strSqlCadastroDetalhesSelect .= "data3, ";
		$strSqlCadastroDetalhesSelect .= "data4, ";
		$strSqlCadastroDetalhesSelect .= "data5, ";
		$strSqlCadastroDetalhesSelect .= "data6, ";
		$strSqlCadastroDetalhesSelect .= "data7, ";
		$strSqlCadastroDetalhesSelect .= "data8, ";
		$strSqlCadastroDetalhesSelect .= "data9, ";
		$strSqlCadastroDetalhesSelect .= "data10, ";
		
		$strSqlCadastroDetalhesSelect .= "cpf_, ";
		$strSqlCadastroDetalhesSelect .= "rg_, ";
		$strSqlCadastroDetalhesSelect .= "cnpj_, ";
		$strSqlCadastroDetalhesSelect .= "documento, ";
		$strSqlCadastroDetalhesSelect .= "i_municipal, ";
		$strSqlCadastroDetalhesSelect .= "i_estadual, ";
		
		$strSqlCadastroDetalhesSelect .= "endereco_principal, ";
		$strSqlCadastroDetalhesSelect .= "endereco_numero_principal, ";
		$strSqlCadastroDetalhesSelect .= "endereco_complemento_principal, ";
		$strSqlCadastroDetalhesSelect .= "bairro_principal, ";
		$strSqlCadastroDetalhesSelect .= "cidade_principal, ";
		$strSqlCadastroDetalhesSelect .= "estado_principal, ";
		$strSqlCadastroDetalhesSelect .= "pais_principal, ";
		$strSqlCadastroDetalhesSelect .= "cep_principal, ";
		
		$strSqlCadastroDetalhesSelect .= "ponto_referencia, ";
		$strSqlCadastroDetalhesSelect .= "email_principal, ";
		$strSqlCadastroDetalhesSelect .= "tel_ddd_principal, ";
		$strSqlCadastroDetalhesSelect .= "tel_principal, ";
		$strSqlCadastroDetalhesSelect .= "cel_ddd_principal, ";
		$strSqlCadastroDetalhesSelect .= "cel_principal, ";
		$strSqlCadastroDetalhesSelect .= "fax_ddd_principal, ";
		$strSqlCadastroDetalhesSelect .= "fax_principal, ";
		$strSqlCadastroDetalhesSelect .= "site_principal, ";
		$strSqlCadastroDetalhesSelect .= "n_funcionarios, ";
		$strSqlCadastroDetalhesSelect .= "obs_interno, ";
		$strSqlCadastroDetalhesSelect .= "id_tb_cadastro_status, ";
		//$strSqlCadastroDetalhesSelect .= "id_tb_cadastro, ";
		$strSqlCadastroDetalhesSelect .= "id_tb_cadastro1, ";
		$strSqlCadastroDetalhesSelect .= "id_tb_cadastro2, ";
		$strSqlCadastroDetalhesSelect .= "id_tb_cadastro3, ";
		$strSqlCadastroDetalhesSelect .= "ativacao, ";
		$strSqlCadastroDetalhesSelect .= "ativacao_destaque, ";
		$strSqlCadastroDetalhesSelect .= "ativacao_mala_direta, ";
		$strSqlCadastroDetalhesSelect .= "usuario, ";
		$strSqlCadastroDetalhesSelect .= "senha, ";
		
		$strSqlCadastroDetalhesSelect .= "imagem, ";
		$strSqlCadastroDetalhesSelect .= "logo, ";
		$strSqlCadastroDetalhesSelect .= "banner, ";
		$strSqlCadastroDetalhesSelect .= "mapa, ";
		
		$strSqlCadastroDetalhesSelect .= "mapa_online, ";
		$strSqlCadastroDetalhesSelect .= "palavras_chave, ";
		$strSqlCadastroDetalhesSelect .= "apresentacao, ";
		$strSqlCadastroDetalhesSelect .= "servicos, ";
		$strSqlCadastroDetalhesSelect .= "promocoes, ";
		$strSqlCadastroDetalhesSelect .= "condicoes_comerciais, ";
		$strSqlCadastroDetalhesSelect .= "formas_pagamento, ";
		$strSqlCadastroDetalhesSelect .= "horario_atendimento, ";
		$strSqlCadastroDetalhesSelect .= "situacao_atual, ";
		
		$strSqlCadastroDetalhesSelect .= "informacao_complementar1, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar2, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar3, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar4, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar5, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar6, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar7, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar8, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar9, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar10, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar11, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar12, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar13, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar14, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar15, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar16, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar17, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar18, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar19, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar20, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar21, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar22, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar23, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar24, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar25, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar26, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar27, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar28, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar29, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar30, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar31, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar32, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar33, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar34, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar35, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar36, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar37, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar38, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar39, ";
		$strSqlCadastroDetalhesSelect .= "informacao_complementar40, ";
		
		$strSqlCadastroDetalhesSelect .= "n_visitas ";
		$strSqlCadastroDetalhesSelect .= "FROM tb_cadastro ";
		$strSqlCadastroDetalhesSelect .= "WHERE id <> 0 ";
		//$strSqlCadastroDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlCadastroDetalhesSelect .= "AND id = :id ";
		//$strSqlCadastroDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		//----------


		//Parâmetros.
		//----------
		$statementCadastroDetalhesSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCadastroDetalhesSelect);
		
		if ($statementCadastroDetalhesSelect !== false)
		{
			$statementCadastroDetalhesSelect->execute(array(
				"id" => $_idTbCadastro
			));
		}
		//----------


		//$resultadoCadastroDetalhes = $dbSistemaConPDO->query($strSqlCadastroDetalhesSelect);
		$resultadoCadastroDetalhes = $statementCadastroDetalhesSelect->fetchAll();
		
		
		//Formato HTML.
        //----------
		if($formatoEmail == 1)
		{
			foreach($resultadoCadastroDetalhes as $linhaCadastroDetalhes)
			{
				//Pedidos (cliente).
				//----------
				if($finalidadeConteudo == 1)
				{
					//Informações Básicas.
					if($linhaCadastroDetalhes['nome'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNome") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome']) . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['razao_social'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroRazaoSocial") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['razao_social']) . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['nome_fantasia'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroNomeFantasia") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome_fantasia']) . $GLOBALS['configQuebraLinha'];
					}
					
					if($linhaCadastroDetalhes['tel_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroTel") . ": " . "(" . $linhaCadastroDetalhes['tel_ddd_principal'] . ") " . $linhaCadastroDetalhes['tel_principal'] . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['cel_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCel") . ": " . "(" . $linhaCadastroDetalhes['cel_ddd_principal'] . ") " . $linhaCadastroDetalhes['cel_principal'] . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['fax_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroFax") . ": " . "(" . $linhaCadastroDetalhes['fax_ddd_principal'] . ") " . $linhaCadastroDetalhes['fax_principal'] . $GLOBALS['configQuebraLinha'];
					}
					
					$strRetorno .= $GLOBALS['configQuebraLinha'];
					
					//Endereço de Cadastro.
					$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosInformacoesClienteEndereco") . $GLOBALS['configQuebraLinha'];
					if($linhaCadastroDetalhes['endereco_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoPrincipal") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['endereco_principal']) . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['endereco_numero_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoNumeroPrincipal") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['endereco_numero_principal']) . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['endereco_complemento_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEnderecoComplementoPrincipal") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['endereco_complemento_principal']) . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['bairro_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroBairroPrincipal") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['bairro_principal']) . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['cidade_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCidadePrincipal") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['cidade_principal']) . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['estado_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroEstadoPrincipal") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['estado_principal']) . $GLOBALS['configQuebraLinha'];
					}
					if($linhaCadastroDetalhes['pais_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroPaisPrincipal") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['pais_principal']) . $GLOBALS['configQuebraLinha'];
					}
					
					if($linhaCadastroDetalhes['cep_principal'] <> "")
					{
						$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCadastroCEPPrincipal") . ": " . Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['cep_principal']) . $GLOBALS['configQuebraLinha'];
					}
		
				}
				//----------

			}
		}
        //----------
		
		//Limpeza de objetos.
		//----------
		unset($strSqlCadastroDetalhesSelect);
		unset($statementCadastroDetalhesSelect);
		unset($resultadoCadastroDetalhes);
		unset($linhaCadastroDetalhes);
		//----------


		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função para montar conteúdo do histórico.
	//**************************************************************************************
	function HistoricoConteudo($_idRegistro, $_formatoEmail)
	{
		//_formatoEmail: 0 ou false - texto | 1 ou true - HTML
		$strRetorno = "";
		
		//Query de pesquisa.
		//----------
		$strSqlHistoricoDetalhesSelect = "";
		$strSqlHistoricoDetalhesSelect .= "SELECT ";
		//$strSqlHistoricoDetalhesSelect .= "* ";
		$strSqlHistoricoDetalhesSelect .= "id, ";
		$strSqlHistoricoDetalhesSelect .= "id_parent, ";
		$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro_usuario, ";
		$strSqlHistoricoDetalhesSelect .= "data_historico, ";
		$strSqlHistoricoDetalhesSelect .= "assunto, ";
		$strSqlHistoricoDetalhesSelect .= "historico, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar1, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar2, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar3, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar4, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar5, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar6, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar7, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar8, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar9, ";
		$strSqlHistoricoDetalhesSelect .= "informacao_complementar10, ";
		//$strSqlHistoricoDetalhesSelect .= "informacao_complementar11, ";
		//$strSqlHistoricoDetalhesSelect .= "informacao_complementar12, ";
		//$strSqlHistoricoDetalhesSelect .= "informacao_complementar13, ";
		//$strSqlHistoricoDetalhesSelect .= "informacao_complementar14, ";
		//$strSqlHistoricoDetalhesSelect .= "informacao_complementar15, ";
		$strSqlHistoricoDetalhesSelect .= "id_tb_historico_status ";
		//$strSqlHistoricoDetalhesSelect .= "ativacao ";
		$strSqlHistoricoDetalhesSelect .= "FROM tb_historico ";
		$strSqlHistoricoDetalhesSelect .= "WHERE id <> 0 ";
		//$strSqlHistoricoDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlHistoricoDetalhesSelect .= "AND id = :id ";
		//$strSqlHistoricoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		//----------

		//Componentes e parâmetros.
		//----------
		$statementHistoricoDetalhesSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlHistoricoDetalhesSelect);
		
		if ($statementHistoricoDetalhesSelect !== false)
		{
			$statementHistoricoDetalhesSelect->execute(array(
				"id" => $_idRegistro
			));
		}
		
		//$resultadoHistoricoDetalhes = $dbSistemaConPDO->query($strSqlHistoricoDetalhesSelect);
		$resultadoHistoricoDetalhes = $statementHistoricoDetalhesSelect->fetchAll();
		//----------


		if (empty($resultadoHistoricoDetalhes))
		{
			//echo "Nenhum registro encontrado";
		}else{
			foreach($resultadoHistoricoDetalhes as $linhaHistoricoDetalhes)
			{
				//Definição das variáveis de detalhes.
				$tbHistoricoId = $linhaHistoricoDetalhes['id'];
				$tbHistoricoIdParent = $linhaHistoricoDetalhes['id_parent'];
				$tbHistoricoIdTbCadastroUsuario = $linhaHistoricoDetalhes['id_tb_cadastro_usuario'];
				$tbHistoricoDataHistorico = Funcoes::DataLeitura01($linhaHistoricoDetalhes['data_historico'], $GLOBALS['configSistemaFormatoData'], "1");
				$tbHistoricoAssunto = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['assunto']);
				$tbHistoricoHistorico = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['historico']);
				$tbHistoricoIC1 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar1']);
				$tbHistoricoIC2 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar2']);
				$tbHistoricoIC3 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar3']);
				$tbHistoricoIC4 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar4']);
				$tbHistoricoIC5 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar5']);
				$tbHistoricoIC6 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar6']);
				$tbHistoricoIC7 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar7']);
				$tbHistoricoIC8 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar8']);
				$tbHistoricoIC9 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar9']);
				$tbHistoricoIC10 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar10']);
				$tbHistoricoIdTbHistoricoStatus = $linhaHistoricoDetalhes['id_tb_historico_status'];
				
				//Verificação de erro.
				//echo "tbHistoricoId=" . $tbHistoricoId . "<br>";
				//echo "tbHistoricoAssunto=" . $tbHistoricoAssunto . "<br>";
				//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
			}
		}
		
		
		//Montagem do conteúdo.
		//----------
		if($_formatoEmail == false)
		{
			//Texto.
			if($tbHistoricoAssunto <> "")
			{
				$strRetorno .= $tbHistoricoAssunto . $GLOBALS['configQuebraLinha'];
			}
			
			$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoData") . ": " . $tbHistoricoDataHistorico . $GLOBALS['configQuebraLinha'];
	
			if($tbHistoricoHistorico <> "")
			{
				$strRetorno .= $tbHistoricoHistorico . $GLOBALS['configQuebraLinha'];
			}
			if($tbHistoricoIC1 <> "")
			{
				$strRetorno .= $tbHistoricoIC1 . $GLOBALS['configQuebraLinha'];
			}
			if($tbHistoricoIC2 <> "")
			{
				$strRetorno .= $tbHistoricoIC2 . $GLOBALS['configQuebraLinha'];
			}
			if($tbHistoricoIC3 <> "")
			{
				$strRetorno .= $tbHistoricoIC3 . $GLOBALS['configQuebraLinha'];
			}
			if($tbHistoricoIC4 <> "")
			{
				$strRetorno .= $tbHistoricoIC4 . $GLOBALS['configQuebraLinha'];
			}
			if($tbHistoricoIC5 <> "")
			{
				$strRetorno .= $tbHistoricoIC5 . $GLOBALS['configQuebraLinha'];
			}
			
			//Link para interação.
			if($GLOBALS['habilitarCadastroHistoricoInteracao'] == 1)
			{
				$strRetorno .= $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoEnvioEmailLink01") . $GLOBALS['configQuebraLinha'];
				$strRetorno .= $GLOBALS['configUrlSSL'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . "SiteAdmHistoricoInteracaoIndice.php?idParent=" . $_idRegistro . $GLOBALS['configQuebraLinha'];
			}
			
		}else{
			//HTML
			if($tbHistoricoAssunto <> "")
			{
				$strRetorno .= "<strong>";
				$strRetorno .= $tbHistoricoAssunto . "<br />";
				$strRetorno .= "</strong>";
			}
			
			$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoData") . ": " . $tbHistoricoDataHistorico . "<br />";
	
			if($tbHistoricoHistorico <> "")
			{
				$strRetorno .= $tbHistoricoHistorico . "<br />";
			}
			if($tbHistoricoIC1 <> "")
			{
				$strRetorno .= $tbHistoricoIC1 . "<br />";
			}
			if($tbHistoricoIC2 <> "")
			{
				$strRetorno .= $tbHistoricoIC2 . "<br />";
			}
			if($tbHistoricoIC3 <> "")
			{
				$strRetorno .= $tbHistoricoIC3 . "<br />";
			}
			if($tbHistoricoIC4 <> "")
			{
				$strRetorno .= $tbHistoricoIC4 . "<br />";
			}
			if($tbHistoricoIC5 <> "")
			{
				$strRetorno .= $tbHistoricoIC5 . "<br />";
			}
			
			//Link para interação.
			if($GLOBALS['habilitarCadastroHistoricoInteracao'] == 1)
			{
				$strRetorno .= "<br />";
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoEnvioEmailLink01") . "<br />";
				$strRetorno .= "<a href='" . $GLOBALS['configUrlSSL'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . "SiteAdmHistoricoInteracaoIndice.php?idParent=" . $_idRegistro . "' target='_blank'>";
				$strRetorno .= $GLOBALS['configUrlSSL'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . "SiteAdmHistoricoInteracaoIndice.php?idParent=" . $_idRegistro;
				$strRetorno .= "<a>";
				$strRetorno .= "<br />";
			}
			
			//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . " " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "<br />";
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlHistoricoDetalhesSelect);
		unset($statementHistoricoDetalhesSelect);
		unset($resultadoHistoricoDetalhes);
		unset($linhaHistoricoDetalhes);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para montar conteúdo do histórico - interação.
	//**************************************************************************************
	function HistoricoInteracaoConteudo($_idRegistro, $_formatoEmail)
	{
		//_formatoEmail: 0 ou false - texto | 1 ou true - HTML
		$strRetorno = "";
		
		//Query de pesquisa.
		//----------
		$strSqlHistoricoInteracaoDetalhesSelect = "";
		$strSqlHistoricoInteracaoDetalhesSelect .= "SELECT ";
		//$strSqlHistoricoInteracaoDetalhesSelect .= "* ";
		$strSqlHistoricoInteracaoDetalhesSelect .= "id, ";
		$strSqlHistoricoInteracaoDetalhesSelect .= "id_parent, ";
		$strSqlHistoricoInteracaoDetalhesSelect .= "id_tb_cadastro_usuario, ";
		$strSqlHistoricoInteracaoDetalhesSelect .= "data_interacao, ";
		$strSqlHistoricoInteracaoDetalhesSelect .= "assunto, ";
		$strSqlHistoricoInteracaoDetalhesSelect .= "interacao ";
		$strSqlHistoricoInteracaoDetalhesSelect .= "FROM tb_historico_interacao ";
		$strSqlHistoricoInteracaoDetalhesSelect .= "WHERE id <> 0 ";
		//$strSqlHistoricoInteracaoDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlHistoricoInteracaoDetalhesSelect .= "AND id = :id ";
		//$strSqlHistoricoInteracaoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		
		
		$statementHistoricoInteracaoDetalhesSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlHistoricoInteracaoDetalhesSelect);
		
		if ($statementHistoricoInteracaoDetalhesSelect !== false)
		{
			$statementHistoricoInteracaoDetalhesSelect->execute(array(
				"id" => $_idRegistro
			));
		}
		
		//$resultadoHistoricoInteracaoDetalhes = $dbSistemaConPDO->query($strSqlHistoricoInteracaoDetalhesSelect);
		$resultadoHistoricoInteracaoDetalhes = $statementHistoricoInteracaoDetalhesSelect->fetchAll();
		
		if (empty($resultadoHistoricoInteracaoDetalhes))
		{
			//echo "Nenhum registro encontrado";
		}else{
			foreach($resultadoHistoricoInteracaoDetalhes as $linhaHistoricoInteracaoDetalhes)
			{
				//Definição das variáveis de detalhes.
				$tbHistoricoInteracaoId = $linhaHistoricoInteracaoDetalhes['id'];
				$tbHistoricoInteracaoIdParent = $linhaHistoricoInteracaoDetalhes['id_parent'];
				$tbHistoricoInteracaoIdTbCadastroUsuario = $linhaHistoricoInteracaoDetalhes['id_tb_cadastro_usuario'];
				$tbHistoricoInteracaoDataInteracao = Funcoes::DataLeitura01($linhaHistoricoInteracaoDetalhes['data_interacao'], $GLOBALS['configSistemaFormatoData'], "1");
				$tbHistoricoInteracaoAssunto = Funcoes::ConteudoMascaraLeitura($linhaHistoricoInteracaoDetalhes['assunto']);
				$tbHistoricoInteracaoInteracao = Funcoes::ConteudoMascaraLeitura($linhaHistoricoInteracaoDetalhes['interacao']);
				
				//Verificação de erro.
				//echo "tbHistoricoInteracaoId=" . $tbHistoricoInteracaoId . "<br>";
				//echo "tbHistoricoInteracaoAssunto=" . $tbHistoricoInteracaoAssunto . "<br>";
				//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
			}
		}
		
		
		//Montagem do conteúdo.
		//----------
		if($_formatoEmail == false)
		{
			//Texto.
			if($tbHistoricoInteracaoAssunto <> "")
			{
				$strRetorno .= $tbHistoricoInteracaoAssunto . $GLOBALS['configQuebraLinha'];
			}
			
			$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemData") . ": " . $tbHistoricoInteracaoDataInteracao . $GLOBALS['configQuebraLinha'];
	
			if($tbHistoricoInteracaoInteracao <> "")
			{
				$strRetorno .= $tbHistoricoInteracaoInteracao . $GLOBALS['configQuebraLinha'];
			}
			
			//Link para interação.
			if($GLOBALS['habilitarCadastroHistoricoInteracao'] == 1)
			{
				$strRetorno .= $GLOBALS['configQuebraLinha'];
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoEnvioEmailLink01") . $GLOBALS['configQuebraLinha'];
				$strRetorno .= $GLOBALS['configUrlSSL'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . "SiteAdmHistoricoInteracaoInteracaoIndice.php?idParent=" . DbFuncoes::GetCampoGenerico01($_idRegistro, "tb_historico_interacao", "id_parent") . $GLOBALS['configQuebraLinha'];
			}
			
		}else{
			//HTML
			if($tbHistoricoInteracaoAssunto <> "")
			{
				$strRetorno .= "<strong>";
				$strRetorno .= $tbHistoricoInteracaoAssunto . "<br />";
				$strRetorno .= "</strong>";
			}
			
			$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemData") . ": " . $tbHistoricoInteracaoDataInteracao . "<br />";
	
			if($tbHistoricoInteracaoInteracao <> "")
			{
				$strRetorno .= $tbHistoricoInteracaoInteracao . "<br />";
			}
			
			//Link para interação.
			if($GLOBALS['habilitarCadastroHistoricoInteracao'] == 1)
			{
				$strRetorno .= "<br />";
				$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaHistoricoInteracaoEnvioEmailLink01") . "<br />";
				$strRetorno .= "<a href='" . $GLOBALS['configUrlSSL'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . "SiteAdmHistoricoInteracaoInteracaoIndice.php?idParent=" . DbFuncoes::GetCampoGenerico01($_idRegistro, "tb_historico_interacao", "id_parent") . "' target='_blank'>";
				$strRetorno .= $GLOBALS['configUrlSSL'] . "/" . $GLOBALS['visualizacaoAtivaSistema'] . "/" . "SiteAdmHistoricoInteracaoInteracaoIndice.php?idParent=" . DbFuncoes::GetCampoGenerico01($_idRegistro, "tb_historico_interacao", "id_parent");
				$strRetorno .= "<a>";
				$strRetorno .= "<br />";
			}
			
			//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . " " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "<br />";
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlHistoricoInteracaoDetalhesSelect);
		unset($statementHistoricoInteracaoDetalhesSelect);
		unset($resultadoHistoricoInteracaoDetalhes);
		unset($linhaHistoricoInteracaoDetalhes);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função para montar conteúdo da tarefa.
	//**************************************************************************************
	function TarefasConteudo($_idRegistro, $_formatoEmail)
	{
		//_formatoEmail: 0 ou false - texto | 1 ou true - HTML
		$strRetorno = "";
		
		//Query de pesquisa.
		//----------
		$strSqlTarefasDetalhesSelect = "";
		$strSqlTarefasDetalhesSelect .= "SELECT ";
		//$strSqlTarefasDetalhesSelect .= "* ";
		$strSqlTarefasDetalhesSelect .= "id, ";
		$strSqlTarefasDetalhesSelect .= "id_parent, ";
		$strSqlTarefasDetalhesSelect .= "data_registro_tarefa, ";
		$strSqlTarefasDetalhesSelect .= "data_tarefa, ";
		$strSqlTarefasDetalhesSelect .= "data_tarefa_final, ";
		$strSqlTarefasDetalhesSelect .= "id_tb_cadastro_usuario, ";
		$strSqlTarefasDetalhesSelect .= "tarefa, ";
		$strSqlTarefasDetalhesSelect .= "descricao, ";
		$strSqlTarefasDetalhesSelect .= "informacao_complementar1, ";
		$strSqlTarefasDetalhesSelect .= "informacao_complementar2, ";
		$strSqlTarefasDetalhesSelect .= "informacao_complementar3, ";
		$strSqlTarefasDetalhesSelect .= "informacao_complementar4, ";
		$strSqlTarefasDetalhesSelect .= "informacao_complementar5, ";
		$strSqlTarefasDetalhesSelect .= "id_tb_tarefa_status, ";
		$strSqlTarefasDetalhesSelect .= "ativacao ";
		$strSqlTarefasDetalhesSelect .= "FROM tb_tarefas ";
		$strSqlTarefasDetalhesSelect .= "WHERE id <> 0 ";
		//$strSqlTarefasDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlTarefasDetalhesSelect .= "AND id = :id ";
		//$strSqlTarefasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		
		
		$statementTarefasDetalhesSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlTarefasDetalhesSelect);
		
		if ($statementTarefasDetalhesSelect !== false)
		{
			$statementTarefasDetalhesSelect->execute(array(
				"id" => $_idRegistro
			));
		}
		
		//$resultadoTarefasDetalhes = $dbSistemaConPDO->query($strSqlTarefasDetalhesSelect);
		$resultadoTarefasDetalhes = $statementTarefasDetalhesSelect->fetchAll();
		
		if (empty($resultadoTarefasDetalhes))
		{
			//echo "Nenhum registro encontrado";
		}else{
			foreach($resultadoTarefasDetalhes as $linhaTarefasDetalhes)
			{
				//Definição das variáveis de detalhes.
				$tbTarefasId = $linhaTarefasDetalhes['id'];
				$tbTarefasIdParent = $linhaTarefasDetalhes['id_parent'];
				$tbTarefasDataRegistroTarefa = Funcoes::DataLeitura01($linhaTarefasDetalhes['data_registro_tarefa'], $GLOBALS['configSistemaFormatoData'], "1");
				$tbTarefasDataTarefa = Funcoes::DataLeitura01($linhaTarefasDetalhes['data_tarefa'], $GLOBALS['configSistemaFormatoData'], "1");
				$tbTarefasDataTarefaFinal = Funcoes::DataLeitura01($linhaTarefasDetalhes['data_tarefa_final'], $GLOBALS['configSistemaFormatoData'], "1");
				$tbTarefasIdTbCadastroUsuario = $linhaTarefasDetalhes['id_tb_cadastro_usuario'];
				$tbTarefasTarefa = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['tarefa']);
				$tbTarefasDescricao = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['descricao']);
				$tbTarefasIC1 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar1']);
				$tbTarefasIC2 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar2']);
				$tbTarefasIC3 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar3']);
				$tbTarefasIC4 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar4']);
				$tbTarefasIC5 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar5']);
				$tbTarefasIdTbTarefaStatus = $linhaTarefasDetalhes['id_tb_tarefa_status'];
				$tbTarefasAtivacao = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['ativacao']);
				
				$tbTarefasIdTbTarefasProcessos = DbFuncoes::GetCampoGenerico04("tb_itens_relacao_registros", "id_registro", "id_item", $tbTarefasId, "", "", 1);
				//Verificação de erro.
				//echo "tbTarefasId=" . $tbTarefasId . "<br>";
				//echo "tbTarefasAssunto=" . $tbTarefasAssunto . "<br>";
				//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
			}
		}
		
	
		
		//Montagem do conteúdo.
		//----------
		if($_formatoEmail == false)
		{
			//Texto.
			if($tbTarefasTarefa <> "")
			{
				$strRetorno .= $tbTarefasTarefa . $GLOBALS['configQuebraLinha'];
			}
			
			$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasData") . ": " . $tbTarefasDataTarefa . $GLOBALS['configQuebraLinha'];
	
			if($tbTarefasDescricao <> "")
			{
				$strRetorno .= $tbTarefasDescricao . $GLOBALS['configQuebraLinha'];
			}
			if($tbTarefasIC1 <> "")
			{
				$strRetorno .= $tbTarefasIC1 . $GLOBALS['configQuebraLinha'];
			}
			if($tbTarefasIC2 <> "")
			{
				$strRetorno .= $tbTarefasIC2 . $GLOBALS['configQuebraLinha'];
			}
			if($tbTarefasIC3 <> "")
			{
				$strRetorno .= $tbTarefasIC3 . $GLOBALS['configQuebraLinha'];
			}
			if($tbTarefasIC4 <> "")
			{
				$strRetorno .= $tbTarefasIC4 . $GLOBALS['configQuebraLinha'];
			}
			if($tbTarefasIC5 <> "")
			{
				$strRetorno .= $tbTarefasIC5 . $GLOBALS['configQuebraLinha'];
			}
			if($tbTarefasIC6 <> "")
			{
				$strRetorno .= $tbTarefasIC6 . $GLOBALS['configQuebraLinha'];
			}
			
		}else{
			//HTML
			if($tbTarefasTarefa <> "")
			{
				$strRetorno .= "<strong>";
				$strRetorno .= $tbTarefasTarefa . "<br />";
				$strRetorno .= "</strong>";
			}
			
			$strRetorno .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaTarefasData") . ": " . $tbTarefasDataTarefa . "<br />";
	
			if($tbTarefasDescricao <> "")
			{
				$strRetorno .= $tbTarefasDescricao . "<br />";
			}
			if($tbTarefasIC1 <> "")
			{
				$strRetorno .= $tbTarefasIC1 . "<br />";
			}
			if($tbTarefasIC2 <> "")
			{
				$strRetorno .= $tbTarefasIC2 . "<br />";
			}
			if($tbTarefasIC3 <> "")
			{
				$strRetorno .= $tbTarefasIC3 . "<br />";
			}
			if($tbTarefasIC4 <> "")
			{
				$strRetorno .= $tbTarefasIC4 . "<br />";
			}
			if($tbTarefasIC5 <> "")
			{
				$strRetorno .= $tbTarefasIC5 . "<br />";
			}
			if($tbTarefasIC6 <> "")
			{
				$strRetorno .= $tbTarefasIC6 . "<br />";
			}
			//$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . " " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "<br />";
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlTarefasDetalhesSelect);
		unset($statementTarefasDetalhesSelect);
		unset($resultadoTarefasDetalhes);
		unset($linhaTarefasDetalhes);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
}