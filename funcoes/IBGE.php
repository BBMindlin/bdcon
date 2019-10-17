<?php
class IBGE
{
	//Função para gravar cidade - DB IBGE.
	//**************************************************************************************
	function MiCadCidadeInsert($_idEstado, 
	$_siglaEstado, 
	$_nome, 
	$_codIBGE, 
	$_data)
	{
		$strRetorno = false;
		//$idContadorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
		//$logData = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		
		$idEstado = $_idEstado;
		$siglaEstado = $_siglaEstado;
		$nome = $_nome; 
		$codIBGE = $_codIBGE; 
		$data = $_data;

	
		//Inclusão de registro no BD.
		//----------
		$strSqlMiCadCidadeInsert = "";
		$strSqlMiCadCidadeInsert .= "INSERT INTO mi_cad_cidade ";
		$strSqlMiCadCidadeInsert .= "SET ";
		//$strSqlMiCadCidadeInsert .= "id = :id, ";
		$strSqlMiCadCidadeInsert .= "id_estado = :id_estado, ";
		$strSqlMiCadCidadeInsert .= "sigla_estado = :sigla_estado, ";
		$strSqlMiCadCidadeInsert .= "nome = :nome, ";
		$strSqlMiCadCidadeInsert .= "cod_ibge = :cod_ibge, ";
		$strSqlMiCadCidadeInsert .= "data = :data ";
		//echo "strSqlMiCadCidadeInsert=" . $strSqlMiCadCidadeInsert . "<br>";
		//----------


		//Criação de componentes.
		//----------
		$statementMiCadCidadeInsert = $GLOBALS['dbIBGEConPDO']->prepare($strSqlMiCadCidadeInsert);
		
		if ($statementMiCadCidadeInsert !== false)
		{
			$statementMiCadCidadeInsert->execute(array(
				"id_estado" => $idEstado,
				"sigla_estado" => $siglaEstado,
				"nome" => $nome,
				"cod_ibge" => $codIBGE,
				"data" => $data
			));
			
			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
			//echo "gravou" . "<br>";
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
			//echo "não gravou" . "<br>";
		}
		//----------


		//Verificação de erro.
		/*echo "idTbItensEnviados=" . $idTbItensEnviados . "<br>";
		echo "dataEnvio=" . $dataEnvio . "<br>";
		echo "_idTbCadastroRemetente=" . $_idTbCadastroRemetente . "<br>";
		echo "_idTbCadastroDestinatario=" . $_idTbCadastroDestinatario . "<br>";
		echo "countEnvio=" . $countEnvio . "<br>";*/
		
		
		//Limpeza de objetos.
		unset($strSqlMiCadCidadeInsert);
		unset($statementMiCadCidadeInsert);
		//----------
		
		return $strRetorno;
	}
	//**************************************************************************************
}