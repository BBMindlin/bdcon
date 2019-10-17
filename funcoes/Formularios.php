<?php
class Formularios
{
	//Função para montar o conteúdo do formulário montado pelo sistema.
	//**************************************************************************************
	function FormularioConteudo($_idTbFormularios, $_formatoEmail)
	{
		//_formatoEmail: true - HTML | false - Texto
		$strRetorno = "";
		
		//Query de pesquisa.
		//----------
		$strSqlFormulariosCamposSelect = "";
		$strSqlFormulariosCamposSelect .= "SELECT ";
		//$strSqlFormulariosCamposSelect .= "* ";
		$strSqlFormulariosCamposSelect .= "id, ";
		$strSqlFormulariosCamposSelect .= "id_tb_formularios, ";
		$strSqlFormulariosCamposSelect .= "n_classificacao, ";
		$strSqlFormulariosCamposSelect .= "nome_campo, ";
		$strSqlFormulariosCamposSelect .= "nome_campo_formatado, ";
		$strSqlFormulariosCamposSelect .= "tipo_campo, ";
		$strSqlFormulariosCamposSelect .= "tamanho_campo, ";
		$strSqlFormulariosCamposSelect .= "altura_campo, ";
		$strSqlFormulariosCamposSelect .= "ativacao, ";
		$strSqlFormulariosCamposSelect .= "obrigatorio ";
		$strSqlFormulariosCamposSelect .= "FROM tb_formularios_campos ";
		$strSqlFormulariosCamposSelect .= "WHERE id <> 0 ";
		$strSqlFormulariosCamposSelect .= "AND id_tb_formularios = :id_tb_formularios ";
		$strSqlFormulariosCamposSelect .= "AND ativacao = 1 ";
		$strSqlFormulariosCamposSelect .= "ORDER BY " . $GLOBALS['configClassificacaoFormulariosCampos'] . " ";
		
		$statementFormulariosCamposSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlFormulariosCamposSelect);
		
		if ($statementFormulariosCamposSelect !== false)
		{
			$statementFormulariosCamposSelect->execute(array(
				"id_tb_formularios" => $_idTbFormularios
			));
		}
		
		//$resultadoFormulariosCampos = $dbSistemaConPDO->query($strSqlFormulariosCamposSelect);
		$resultadoFormulariosCampos = $statementFormulariosCamposSelect->fetchAll();
		
		
		if (empty($resultadoFormulariosCampos))
		{
			//echo "Nenhum registro encontrado";
		}else{
			//Loop pelos resultados.
			foreach($resultadoFormulariosCampos as $linhaFormulariosCampos)
			{
				//Formato texto.
				//----------------------
				
				//Campo de texto.
				if($linhaFormulariosCampos['tipo_campo'] == 1)
				{
					if(!empty($_POST[$linhaFormulariosCampos['nome_campo_formatado']])){
						if($_formatoEmail == false)
						{
							//$emailCorpoMensagemTexto .= $linhaFormulariosCampos['nome_campo'] . ": " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
							//$emailCorpoMensagemTexto .= $linhaFormulariosCampos['nome_campo'] . ": " . utf8_encode($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . " " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
							//$emailCorpoMensagemTexto .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo'], "utf8_encode") . ": " . utf8_encode($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
							//$emailCorpoMensagemTexto .= Funcoes::ConteudoMascaraGravacao01($linhaFormulariosCampos['nome_campo']) . ": " . utf8_encode($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
							//$emailCorpoMensagemTexto .= utf8_encode($linhaFormulariosCampos['nome_campo']) . ": " . utf8_encode($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
						}else{
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . " " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "<br />";
						}
					}
				}
				
				//Área de texto.
				if($linhaFormulariosCampos['tipo_campo'] == 2)
				{
					if(!empty($_POST[$linhaFormulariosCampos['nome_campo_formatado']])){
						if($_formatoEmail == false)
						{
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . " " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n";
						}else{
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . " " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "<br />";
						}
					}
				}
				
				//DropDownMenu.
				if($linhaFormulariosCampos['tipo_campo'] == 5)
				{
					if(!empty($_POST[$linhaFormulariosCampos['nome_campo_formatado']])){
						if($_formatoEmail == false)
						{
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . " " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n";
						}else{
							$strRetorno .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . " " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "<br />";
						}
					}
				}
				
				//DropDownMenu.
				/*if($linhaFormulariosCampos['tipo_campo'] == 7)
				{
					$emailCorpoMensagemTexto .= $linhaFormulariosCampos['nome_campo'] . "/n";
				}
				
				//Subtítulo explicativo.
				if($linhaFormulariosCampos['tipo_campo'] == 8)
				{
					$emailCorpoMensagemTexto .= $linhaFormulariosCampos['nome_campo'] . "/n";
				}*/
				
				
				//$emailCorpoMensagemTexto .= "";
				//----------------------
			}
		}
		
		//Limpeza de objetos.
		//----------
		unset($strSqlFormulariosCamposSelect);
		unset($statementFormulariosCamposSelect);
		unset($resultadoFormulariosCampos);
		unset($linhaFormulariosCampos);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para montar o conteúdo do formulário montado pelo sistema.
	//**************************************************************************************
	function CadastroFormulariosCampos($_idTipoCadastro)
	{
		//Variáveis.
		//----------
		//$strRetorno = [];
		$strRetorno = "";
		$arrTipoCadastro = explode(",", $_idTipoCadastro);
		//----------


		//Tipo.
		//----------
		if(in_array($GLOBALS['configIdCadastroCliente'], $arrTipoCadastro) == true)
		{
			$strRetorno = $GLOBALS['configCadastroFormularioCamposCliente'];
		}
		if(in_array($GLOBALS['configIdCadastroUsuario'], $arrTipoCadastro) == true)
		{
			$strRetorno = $GLOBALS['configCadastroFormularioCamposUsuario'];
		}
		if(in_array($GLOBALS['configIdCadastroUsuarioVendedor'], $arrTipoCadastro) == true)
		{
			$strRetorno = $GLOBALS['configCadastroFormularioCamposUsuarioVendedor'];
		}
		if(in_array($GLOBALS['configIdCadastroUsuarioRH'], $arrTipoCadastro) == true)
		{
			$strRetorno = $GLOBALS['configCadastroFormularioCamposUsuarioRH'];
		}
		if(in_array($GLOBALS['configIdCadastroAssinante'], $arrTipoCadastro) == true)
		{
			$strRetorno = $GLOBALS['configCadastroFormularioCamposAssinante'];
		}
		if(in_array($GLOBALS['configIdCadastroSimples'], $arrTipoCadastro) == true)
		{
			$strRetorno = $GLOBALS['configCadastroFormularioCamposSimples'];
		}
		//----------
		
		
		//Atividades.
		//----------
		if($strRetorno == "")
		{
			$arrConfigCadastroFormularioCamposAtividades = explode(";", $GLOBALS['configCadastroFormularioCamposAtividades']);
			for($countArray = 0; $countArray < (count($arrConfigCadastroFormularioCamposAtividades) - 1); $countArray++)
			{
				if(in_array($arrConfigCadastroFormularioCamposAtividades[$countArray], $arrTipoCadastro) == true)
				{
					$strRetorno = $arrConfigCadastroFormularioCamposAtividades[$countArray + 1];
				}
				
				
				//Debug.
				//echo "arrConfigCadastroFormularioCamposAtividades=" . $arrConfigCadastroFormularioCamposAtividades[$countArray] . "<br />";
				//if($arrConfigCadastroFormularioCamposAtividades[$countArray] == $_idTipoCadastro)
				//{
					//echo "configCadastroFormularioCampos=" . $arrConfigCadastroFormularioCamposAtividades[$countArray + 1] . "<br />";
				//}
			}
		}
		//----------

		
		//Verificação de erro - debug.
		//print_r($arrTipoCadastro);
		//echo "<br />";
		//print_r("arrTipoCadastro=" . $arrTipoCadastro);
		//echo "strRetorno=" . $strRetorno . "<br />";
		
		return $strRetorno;
	}
	//**************************************************************************************	
}