<?php
class Funcoes
{
	//Função para capturar a extenção do arquivo.
	//**************************************************************************************
	function GetArquivoExtensao($caminhoArquivo)
	{
		//Variáveis.
		$strReturn = "";
		$arquivoExtensao = "";
		
		
		if($caminhoArquivo <> "")
		{
			$arquivoExtensao = pathinfo(strtolower($caminhoArquivo), PATHINFO_EXTENSION);
			
			
			//Retirada de parâmetros depois da extenção.
			if($arquivoExtensao <> "")
			{
					$arrArquivoExtensao = explode("?", $arquivoExtensao);
					$arquivoExtensao = $arrArquivoExtensao[0];
			}
		}
		

		$strReturn = "." . $arquivoExtensao;
		return $strReturn;
	}
	//**************************************************************************************
	
	
	//Função para formatar data para gravação do banco de dados.
	//**************************************************************************************
	function DataGravacaoSql($strData, $strFormatoData)
	{
		$strReturn = "";
		
		if($strData <> "")
		{
			$arrData = explode("/", $strData);
			
			if($strFormatoData == 1)
			{
				$strReturn = $arrData[2] . "-" . $arrData[1] . "-" . $arrData[0];
			}
			
			if($strFormatoData == 2)
			{
				$strReturn = $arrData[2] . "-" . $arrData[0] . "-" . $arrData[1];
			}
		}
		
		return $strReturn;
	}
	//**************************************************************************************
	
	
	//Função para formatar data.
	//**************************************************************************************
	function DataLeitura01($strData, $strFormatoData, $strFormatoRetorno)
	{
		//$strFormatoRetorno: 1 - (dd/mm/aaaa | mm/dd/aaaa) | 2 - (dd/mm/aaaa hh:mm:ss | mm/dd/aaaa hh:mm:ss) | 3 - aaaa-mm-dd hh:mm:ss | 10 - (aaaa-mm-dd) | 11 - aaaa-mm-ddThh:mm:ss | 22 - hh:mm:ss
		$strReturn = "";
		
		if($strData <> NULL)
		{
			if($strFormatoRetorno == "1")
			{
				if($strFormatoData == 1){
					$strReturn = date("d",strtotime($strData)) . "/" . date("m",strtotime($strData)) . "/" . date("Y",strtotime($strData));
				}
				if($strFormatoData == 2){
					$strReturn = date("m",strtotime($strData)) . "/" . date("d",strtotime($strData)) . "/" . date("Y",strtotime($strData));
				}
			}
			
			if($strFormatoRetorno == "2")
			{
				if($strFormatoData == 1){
					$strReturn = date("d",strtotime($strData)) . "/" . date("m",strtotime($strData)) . "/" . date("Y",strtotime($strData)) . " " . date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
				}
				if($strFormatoData == 2){
					$strReturn = date("m",strtotime($strData)) . "/" . date("d",strtotime($strData)) . "/" . date("Y",strtotime($strData)) . " " . date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
				}
			}
			
			if($strFormatoRetorno == "3")
			{
				$strReturn = date("Y",strtotime($strData)) . "-" . date("m",strtotime($strData)) . "-" . date("d",strtotime($strData)) . " " . date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
			}
			
			if($strFormatoRetorno == "10")
			{
				$strReturn = date("Y",strtotime($strData)) . "-" . date("m",strtotime($strData)) . "-" . date("d",strtotime($strData));
			}
			
			if($strFormatoRetorno == "11")
			{
				$strReturn = date("Y",strtotime($strData)) . "-" . date("m",strtotime($strData)) . "-" . date("d",strtotime($strData)) . "T" . date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
			}
			
			if($strFormatoRetorno == "22")
			{
				$strReturn = date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
			}
		}
		
		return $strReturn;
	}
	//**************************************************************************************
	
	
	//Função para retornar intervalo entre datas (metodologia alternativa).
	//**************************************************************************************
	function DataIntervalo02($tipoRetorno, $_strDataInicial, $_strDataFinal)
	{
		//tipoRetorno: y (anos) | mm (meses) | d (dias) | h (horas) | hN (horas + fração) | m (minutos)
		// $_strDataInicial / $_strDataFinal: formato - aaaa-mm-ddThh:mm:ss - DataLeitura01("data", $GLOBALS['configSistemaFormatoData'], "11")
		//ref:
		//http://stackoverflow.com/questions/676824/how-to-calculate-the-difference-between-two-dates-using-php
		
		$strReturn = "";
		
		if($_strDataFinal <> "")
		{
			$strDataInicial = new DateTime($_strDataInicial);
			$strDataFinal = new DateTime($_strDataFinal);
			$strDataIntervalo = $strDataInicial->diff($strDataFinal); //php 5.3
			
			//Abaixo de php 5.2.
			/*
			$strDataInicial = strtotime(str_replace("T", "", $_strDataInicial));
			$strDataFinal = strtotime(str_replace("T", "", $_strDataFinal));
			$strDataIntervalo = $strDataInicial - $strDataFinal;
			*/
			
			//Anos.
			//----------------------
			if($tipoRetorno == "y")
			{
				$strReturn = $strDataIntervalo->y;
			}
			//----------------------


			//Meses.
			//----------------------
			if($tipoRetorno == "mm")
			{
				$strReturn = $strDataIntervalo->m;
				
				
				//Abaixo de php 5.2.
				//$strReturn = round($strDataIntervalo / 60);
			}
			//----------------------
			
			
			//Dias.
			//----------------------
			if($tipoRetorno == "d")
			{
				$strReturn = $strDataIntervalo->d;
			}
			//----------------------

			
			//Horas.
			//----------------------
			if($tipoRetorno == "h")
			{
				//php 5.3
				$strDataIntervaloHoras = $strDataIntervalo->h;
				$strReturn = $strDataIntervaloHoras + ($strDataIntervalo->days * 24);
				
				//php 5.2
				//$days = round(($end->format('U') - $start->format('U')) / (60*60*24));
				//$hours = round(($end->format('U') - $start->format('U')) / (60*60));
				//$strReturn = round(($strDataInicial->format('U') - $strDataFinal->format('U')) / (60*60));
				
				//$horas = $strDataIntervalo->h;
				//$horas = $horas + ($diff->days*24);
				
				//$strReturn = $strDataIntervalo->h;
				//$strReturn = $horas;
				//$strReturn = "teste";
				//$strReturn = $strDataIntervalo->format('%h');
				
				
				//Abaixo de php 5.2.
				//$strReturn = round($strDataIntervalo / (60 * 60));
			}
			//----------------------
			
			
			//Minutos.
			//----------------------
			if($tipoRetorno == "m")
			{
				$intervaloMinutos = $strDataIntervalo->days * 24 * 60;
				$intervaloMinutos += $strDataIntervalo->h * 60;
				$intervaloMinutos += $strDataIntervalo->i;
				
				//$strReturn = $strDataIntervalo->i;
				$strReturn = $intervaloMinutos;
			}
			//----------------------
		}
		
		return $strReturn;
	}
	//**************************************************************************************
	
	
	//Função para alterar datas.
	//**************************************************************************************
	function DataAlterar01($_strData, $dataIntervalo, $dataIntervaloOperacao, $tipoIntervalo)
	{
		//tipoIntervalo: y (anos) | mm (meses) | d (dias) | h (horas) | m (minutos)
		//dataIntervaloOperacao: + (adicionar) | - (subtrair)
		//ref (operadores): http://php.net/manual/en/datetime.modify.php
		//ref (formato): http://php.net/manual/en/datetime.format.php
		
		//if($_strData <> "")
		if(!empty($_strData))
		{
			//Criação de algumas variáveis.
			//----------------------
			$strRetorno = "";
			$strData = new DateTime($_strData);
			//$strData = new DateTime('2006-12-12');
			//----------------------
			
			
			//m - Minutos.
			//----------------------
			if($tipoIntervalo == "m")
			{
				//$strData->modify('+5 day');
				//$strData->modify('+' . $dataIntervalo . ' day');
				//$strData->modify($dataIntervaloOperacao . "{" . $dataIntervalo . "}" . ' minutes');
				$strData->modify($dataIntervaloOperacao . $dataIntervalo . ' minutes');
				
				$strRetorno = $strData->format('Y-m-d H:i:s');
			}
			//----------------------
			
			
			//d - Dias.
			//----------------------
			if($tipoIntervalo == "d")
			{
				//$strData->modify('+5 day');
				//$strData->modify('+' . $dataIntervalo . ' day');
				$strData->modify($dataIntervaloOperacao . $dataIntervalo . ' day');
				
				$strRetorno = $strData->format('Y-m-d');
			}
			//----------------------
			
			
			//mm - Meses.
			//----------------------
			if($tipoIntervalo == "mm")
			{
				//$strData->modify('+5 day');
				//$strData->modify('+' . $dataIntervalo . ' day');
				$strData->modify($dataIntervaloOperacao . $dataIntervalo . ' month');
				
				$strRetorno = $strData->format('Y-m-d');
			}
			//----------------------
			
			
			//$strRetorno = $strData->format('Y-m-d');
			//$strRetorno = $strData;
		}
		
		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função para traduzir partes da data.
	//**************************************************************************************
	function DataTraducao($dataInformacao, $dataPropriedade, $idioma)
	{
		//$dataPropriedade: s (dia da semana) | m (mês)
		
		$strRetorno = "";
		
		//Portugês.
		//----------------------
		if($idioma == "pt-br")
		{
			//Dia de Semana.
			if($dataPropriedade == "s")
			{
				if($dataInformacao == "Sunday")
				{
					$strRetorno = "Domingo";
				}
				if($dataInformacao == "Monday")
				{
					$strRetorno = "Segunda";
				}
				if($dataInformacao == "Tuesday")
				{
					$strRetorno = "Terça";
				}
				if($dataInformacao == "Wednesday")
				{
					$strRetorno = "Quarta";
				}
				if($dataInformacao == "Thursday")
				{
					$strRetorno = "Quinta";
				}
				if($dataInformacao == "Friday")
				{
					$strRetorno = "Sexta";
				}
				if($dataInformacao == "Saturday")
				{
					$strRetorno = "Sábado";
				}
			}
			
			//Dia de Semana.
			if($dataPropriedade == "m")
			{
				if($dataInformacao == "January")
				{
					$strRetorno = "Janeiro";
				}
				if($dataInformacao == "February")
				{
					$strRetorno = "Fevereiro";
				}
				if($dataInformacao == "March")
				{
					$strRetorno = "Março";
				}
				if($dataInformacao == "April")
				{
					$strRetorno = "Abril";
				}
				if($dataInformacao == "May")
				{
					$strRetorno = "Maio";
				}
				if($dataInformacao == "June")
				{
					$strRetorno = "Junho";
				}
				if($dataInformacao == "July")
				{
					$strRetorno = "Julho";
				}
				if($dataInformacao == "August")
				{
					$strRetorno = "Agosto";
				}
				if($dataInformacao == "September")
				{
					$strRetorno = "Setembro";
				}
				if($dataInformacao == "October")
				{
					$strRetorno = "Outubro";
				}
				if($dataInformacao == "November")
				{
					$strRetorno = "Novembro";
				}
				if($dataInformacao == "December")
				{
					$strRetorno = "Dezembro";
				}
			}
		}
		//----------------------
		
		return $strRetorno;
	}
	//**************************************************************************************


	//Funções para tratamento de leitura de dados.
	//**************************************************************************************
	function ConteudoMascaraLeitura($strConteudo, $instrucoesEspeciais = "")
	{
		//instrucoesEspeciais: utf8_encode | htmlentities | IncludeConfig | pdf (conersão em texto)
		
		$strReturn = "";
		
		
		//Leitura de variáveis do banco de dados.
		//----------
		//(|(nome_do_campo)|)
		if($GLOBALS['ConfigIdCategoriasConteudoModelo'] <> 0)
		{
			//tb_cadastro
			if($_GET["idTbCadastro"] <> "")
			{
				//nome
				if(strpos($strConteudo, '(|(nome)|)') !== false)
				{
					//$strConteudo = str_replace("(|(nome_do_campo)|)",DbFuncoes::GetCampoGenerico01($idTbCadastro, "tb_cadastro", "nome"), $strConteudo);
					//$strConteudo = str_replace("(|(nome)|)",DbFuncoes::GetCampoGenerico01("4122", "tb_cadastro", "nome"), $strConteudo);
					$strConteudo = str_replace("(|(nome)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "nome"), $strConteudo);
				}
				
				//razao_social
				if(strpos($strConteudo, '(|(razao_social)|)') !== false)
				{
					$strConteudo = str_replace("(|(razao_social)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "razao_social"), $strConteudo);
				}
				
				//nome_fantasia
				if(strpos($strConteudo, '(|(nome_fantasia)|)') !== false)
				{
					$strConteudo = str_replace("(|(nome_fantasia)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "nome_fantasia"), $strConteudo);
				}
				
				//cpf_
				if(strpos($strConteudo, '(|(cpf_)|)') !== false)
				{
					$strConteudo = str_replace("(|(cpf_)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "cpf_"), $strConteudo);
				}
				
				//rg_
				if(strpos($strConteudo, '(|(rg_)|)') !== false)
				{
					$strConteudo = str_replace("(|(rg_)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "rg_"), $strConteudo);
				}
				
				//cnpj_
				if(strpos($strConteudo, '(|(cnpj_)|)') !== false)
				{
					$strConteudo = str_replace("(|(cnpj_)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "cnpj_"), $strConteudo);
				}
				
				//i_municipal
				if(strpos($strConteudo, '(|(i_municipal)|)') !== false)
				{
					$strConteudo = str_replace("(|(i_municipal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "i_municipal"), $strConteudo);
				}
				
				//i_estadual
				if(strpos($strConteudo, '(|(i_estadual)|)') !== false)
				{
					$strConteudo = str_replace("(|(i_estadual)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "i_estadual"), $strConteudo);
				}
				
				//endereco_principal
				if(strpos($strConteudo, '(|(endereco_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(endereco_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "endereco_principal"), $strConteudo);
				}
				
				//endereco_numero_principal
				if(strpos($strConteudo, '(|(endereco_numero_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(endereco_numero_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "endereco_numero_principal"), $strConteudo);
				}
				
				//endereco_complemento_principal
				if(strpos($strConteudo, '(|(endereco_complemento_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(endereco_complemento_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "endereco_complemento_principal"), $strConteudo);
				}
				
				//bairro_principal
				if(strpos($strConteudo, '(|(bairro_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(bairro_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "bairro_principal"), $strConteudo);
				}
				
				//cidade_principal
				if(strpos($strConteudo, '(|(cidade_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(cidade_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "cidade_principal"), $strConteudo);
				}
				
				//estado_principal
				if(strpos($strConteudo, '(|(estado_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(estado_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "estado_principal"), $strConteudo);
				}
				
				//pais_principal
				if(strpos($strConteudo, '(|(pais_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(pais_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "pais_principal"), $strConteudo);
				}
				
				//cep_principal
				if(strpos($strConteudo, '(|(cep_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(cep_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "cep_principal"), $strConteudo);
				}
				
				//email_principal
				if(strpos($strConteudo, '(|(email_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(email_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "email_principal"), $strConteudo);
				}
				
				//tel_ddd_principal
				if(strpos($strConteudo, '(|(tel_ddd_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(tel_ddd_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "tel_ddd_principal"), $strConteudo);
				}
				
				//tel_principal
				if(strpos($strConteudo, '(|(tel_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(tel_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "tel_principal"), $strConteudo);
				}
				
				//cel_ddd_principal
				if(strpos($strConteudo, '(|(cel_ddd_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(cel_ddd_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "cel_ddd_principal"), $strConteudo);
				}
				
				//cel_principal
				if(strpos($strConteudo, '(|(cel_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(cel_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "cel_principal"), $strConteudo);
				}
				
				//fax_ddd_principal
				if(strpos($strConteudo, '(|(fax_ddd_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(fax_ddd_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "fax_ddd_principal"), $strConteudo);
				}
				
				//fax_principal
				if(strpos($strConteudo, '(|(fax_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(fax_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "fax_principal"), $strConteudo);
				}
				
				//site_principal
				if(strpos($strConteudo, '(|(site_principal)|)') !== false)
				{
					$strConteudo = str_replace("(|(site_principal)|)", DbFuncoes::GetCampoGenerico01($_GET["idTbCadastro"], "tb_cadastro", "site_principal"), $strConteudo);
				}
				
			}
		}
		//$strConteudo = str_replace("(|(","DbFuncoes::GetCampoGenerico01($idTbCadastro, 'tb_cadastro', '", $strConteudo);
		//$strConteudo = str_replace("(|(","<?php echo DbFuncoes::GetCampoGenerico01('4122', 'tb_cadastro', '", $strConteudo);
		//$strConteudo = str_replace(")|)","');?//>", $strConteudo);
		////DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro2, "tb_cadastro", "nome")
		
		//funcionando.
		/*$text = '[This] is a [test] string, [eat] my [shorts].';
		preg_match_all("/\[([^\]]*)\]/", $text, $matches);
		var_dump($matches[1]);
		*/
		
		//$text = '||This] is a ||test] string, ||eat] my ||shorts].';
		//preg_match_all("/\||(.*?)\]/", $text, $matches);
		//var_dump($matches[1]);
		
		//funcionando bem
		//$in = "hello [world], my name (is andrew) and my number is (845) 235-0184";
		////preg_match_all('/\(([A-Za-z0-9 ]+?)\)/', $in, $out);
		//preg_match_all('/\[(.*?)\]/', $in, $out);
		//print_r($out[1]);
		////print_r($out[1][0]);
		
		//$string = 'hello [world], my name (is andrew) and my number is (845) 235-0184';
		//$pattern = '/\[(.*?)\]/';
		//$replacement = '${1}1,$3';
		//echo preg_replace($pattern, $replacement, $string);
		
		
		//$name = "[hi] helloz [hello] (hi) {jhihi}";
		//echo preg_replace('/[\[{\(].*[\]}\)]/U' , 'teste', $name);
		//----------

		
		//$strConteudo = htmlentities($strConteudo);
		$strConteudo = nl2br($strConteudo);
		//$strConteudo = htmlentities($strConteudo);
		//$strConteudo = htmlspecialchars_decode(htmlentities($strConteudo, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES);
		//$strConteudo = htmlspecialchars($strConteudo);
		//$strConteudo = htmlspecialchars($strConteudo, ENT_COMPAT,'ISO-8859-1', true);
		//$strConteudo = html_entity_decode($strConteudo);
		//$strConteudo = htmlspecialchars_decode(htmlentities($strConteudo, ENT_NOQUOTES, 'UTF-8'), ENT_NOQUOTES);
		//$strConteudo = utf8_decode($strConteudo);
		//$strConteudo = utf8_encode($strConteudo); //Desativei ao usar PDO.
		
		
		//Retirar a contra barra dos caracteres escapados.
		//http://php.net/manual/en/function.addslashes.php
		$strConteudo = stripslashes($strConteudo);
		
		
		//Condição especial para caixa sem formatação.
		if($GLOBALS['configConteudoCaixaTexto'] == 1)
		{
			//$strConteudo = strip_tags($strConteudo, "
			//<br><br/><br />
			//");
			//$strConteudo = preg_replace("/<br\W*?\/>/", "\n", $strConteudo);
			//$strConteudo = preg_replace("/<br\W*?\/>/", "", $strConteudo);
			
			
			//$strConteudo = "<pre>" . $strConteudo . "</pre>";
		}
		
		
		if(strpos($instrucoesEspeciais, "utf8_encode") !== false) {
			$strConteudo = utf8_encode($strConteudo);
		}
		
		if(strpos($instrucoesEspeciais, "htmlentities") !== false) {
			$strConteudo = htmlentities($strConteudo);
		}
		
		//Tratamento de dados de texto do IncludeConfig.
		//if($instrucoesEspeciais == "IncludeConfig") {
		if(strpos($instrucoesEspeciais, "IncludeConfig") !== false) {
			if($GLOBALS['configPlataforma'] == "windows")
			{
				$strConteudo = utf8_encode($strConteudo);
				$strConteudo = htmlentities($strConteudo);
			}
			
			//$strConteudo = htmlentities($strConteudo);
			//$strConteudo = utf8_encode($strConteudo);
			
			if($GLOBALS['configPlataforma'] == "linux")
			{
				$strConteudo = utf8_encode($strConteudo);
			}
		}
		
		//pdf.
		if(strpos($instrucoesEspeciais, "pdf") !== false) {
			if($GLOBALS['configPlataforma'] == "windows")
			{
				$strConteudo = utf8_encode($strConteudo);
			}
			
			//$strConteudo = htmlentities($strConteudo);
			$strConteudo = utf8_encode($strConteudo);
		}
		
		//Útil para gravação de arquivos.
		if(strpos($instrucoesEspeciais, "exportacao") !== false) {
			if($GLOBALS['configPlataforma'] == "linux")
			{
				$strConteudo = utf8_encode($strConteudo);
				$strConteudo = html_entity_decode($strConteudo);
			}
		}
		
		//Retirar espaços, tabs e quebra de linha.
		if(strpos($instrucoesEspeciais, "limpar_espacos_tabs_quebra") !== false) {
			$strConteudo = preg_replace('/\s+/', ' ', $strConteudo);
		}

		//Retirar espaços e tabs abundantes (manter quebra de linha).
		if(strpos($instrucoesEspeciais, "limpar_espacos_tabs") !== false) {
			$strConteudo = preg_replace("/[ \t]+/", " ", $strConteudo);
		}
		
		//Retirar CR e LF (identificável no notepad++).
		if(strpos($instrucoesEspeciais, "limpar_cr_lf") !== false) {
			$strConteudo = preg_replace("/[\r\n]+/", "", $strConteudo);
		}
		
		//Retirar tags br.
		if(strpos($instrucoesEspeciais, "limpar_br") !== false) {
			$strConteudo = preg_replace("/<br\W*?\/>/", "", $strConteudo);
		}
		
		//json_encode (indicado para tratamento de dados integrado com javascript.
		//ref: http://php.net/manual/en/function.json-encode.php
		if(strpos($instrucoesEspeciais, "json_encode") !== false) {
			$strConteudo = json_encode($strConteudo, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		}
		
		//Inclusão de css de link.
		$strConteudo = str_replace("href", "class='ConteudoLinks' href", $strConteudo);
		
		$strReturn = $strConteudo;
		return $strReturn;
	}
	//**************************************************************************************


	//Função para tratamento de gravação de conteúdo.
	//**************************************************************************************
	function ConteudoMascaraGravacao01($strConteudo)
	{
		$strRetorno = "";
		
		//Quebra de linhas.
		//$strConteudo = str_replace("</p>","<br />",$strConteudo);
		//$strConteudo = nl2br($strConteudo);
		
		//Sanitization.
		$strConteudo = $GLOBALS['dbSistemaConMysqli']->real_escape_string($strConteudo);
		//$strConteudo = stripslashes($strConteudo);
		$strConteudo = stripcslashes($strConteudo); 
		//$strConteudo = htmlentities($strConteudo);
		
		
		//HTML permitido.
		//<br><br/><br />
		$strConteudo = strip_tags($strConteudo, "
		<strong></strong>
		<em></em>
		<u></u>
		<strike></strike>
		<sub></sub>
		<sup></sup>
		<a></a>
		<iframe></iframe>
		<span></span>
		<table></table>
		<td></td>
		<tr></tr>
		<div></div>
		");
		
		//Condição especial para caixa sem formatação.
		if($GLOBALS['configConteudoCaixaTexto'] <> 1)
		{
			$strConteudo = strip_tags($strConteudo, "
			<br><br/><br />
			");
		}
		
		$strRetorno = $strConteudo;
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para gravar valores monetários formatados.
	//**************************************************************************************
	function MascaraValorGravar($strValor)
	{
		//$strRetorno = "";
		$strRetorno = $strValor;
		
		$strRetorno = str_replace(",", "", $strRetorno);
		$strRetorno = str_replace(".", "", $strRetorno);
		
		return $strRetorno;
		
	}
	//**************************************************************************************
	
	
	//Função para formaração de leitura de valores monetários.
	//**************************************************************************************
	function MascaraValorLer($strValor, $configMoeda = "R$")
	{
		//configMoeda: pagseguro | paypal | boleto
		//Obs: mudar configMoeda para formatacaoEspecial
		
		//Variáveis.
		//----------
		$strRetorno = "";
		$strValor = strval($strValor); //Conversão para string.
		//----------

		
		if($strValor <> "")
		{
			if(strlen($strValor) < 3)
			{
				$strValor = "00" . $strValor;
			}
			
			$strDecimal = substr($strValor, (strlen($strValor) - 2), strlen($strValor));
			$strValor = substr($strValor, 0, strlen($strValor) - 2) . "." . $strDecimal;
			
			//R$ (Real)
			if($configMoeda == "R$")
			{
				$strRetorno = number_format($strValor, 2, ',', '.');
			}
			
			//$ (dólar)
			if($configMoeda == "$")
			{
				$strRetorno = number_format($strValor, 2, '.', ',');
			}
			
			//PagSeguro.
			if($configMoeda == "pagseguro")
			{
				$strRetorno = number_format($strValor, 2, '.', ',');
			}
	
			//Paypal.
			if($configMoeda == "paypal")
			{
				$strRetorno = number_format($strValor, 2, '.', '');
			}
	
			/*
			//Verificação se o valor é negativo.
			if($strValor < 0)
			{
				$flagValorNegativo = 1;
			}
			
			
			if($flagValorNegativo == 1)
			{
				
			}else{
				//R$ (Real)
				if($configMoeda == "R$")
				{
					$strRetorno = number_format($strValor, 2, ',', '.');
				}
				
				//$ (dólar)
				if($configMoeda == "$")
				{
					$strRetorno = number_format($strValor, 2, '.', ',');
				}
			}
			*/
			
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
    //Função para formatação de números de telefones.
	//**************************************************************************************
	function FormatarTelefoneLer($numeroTelefone)
	{
		$strRetorno = $numeroTelefone;
		
		return $strRetorno;
	}
	//**************************************************************************************


    //Função para formaração de gravação de telefone.
	//**************************************************************************************
	function FormatarTelefoneGravar($numeroTelefone)
	{
		$strRetorno = $numeroTelefone;
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
    //Função para retornar valores formatados (antigos: formatar_cpf_ler, formatar_cpf_ler).
	//**************************************************************************************
	function FormatarValorGenericoLer($strDados, $tipoDados)
	{
		//tipoDados: cpf | cnpj | cep
		$strRetorno = "";
		$strDadosLength = Funcoes::SomenteNum($strDados);
		
		if($strDados <> "")
		{
			//CPF
			if($tipoDados == "cpf")
			{
				if(strlen($strDadosLength) == 11)
				{
					$strRetorno	= substr($strDados , 0, 3) . "." . substr($strDados , 3, 3) . "." . substr($strDados , 6, 3) . "-" . substr($strDados , 9, 2);
				}else{
					$strRetorno = $strDados;
				}
			}
			
			//CNPJ
			if($tipoDados == "cnpj")
			{
				if(strlen($strDadosLength) == 14)
				{
					$strRetorno	= substr($strDados , 0, 2) . "." . substr($strDados , 2, 3) . "." . substr($strDados , 5, 3) . "/" . substr($strDados , 8, 4) . "-" . substr($strDados , 12, 2);
				}else{
					$strRetorno = $strDados;
				}
			}
			
			//CEP
			if($tipoDados == "cep")
			{
				if(strlen($strDadosLength) == 8)
				{
					$strRetorno	= substr($strDados , 0, 2) . "." . substr($strDados , 2, 3) . "-" . substr($strDados , 4, 3);
				}else{
					$strRetorno = $strDados;
				}
			}
		}
		
		
		return $strRetorno;
	}
	//**************************************************************************************


	//Função para retornar uma determinada parte do conteúdo.
	//**************************************************************************************
	function ConteudoRetornoArray01_backup01($strConteudo, $tipoRetorno)
	{
		$strRetorno = "";
		$countArray = 0;
		//tipoRetorno: 1 - última parte do array
		
		$arrStrConteudo = explode("/", $strConteudo);
		
		if($tipoRetorno = 1)
		{
			foreach($arrStrConteudo as $valor)
			{
				//$strRetorno = $arrStrConteudo[$countArray] => $valor;
				$strRetorno = $valor;
				//$countArray++;
			}
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para tratamento de arrays.
	//**************************************************************************************
	function ConteudoRetornoArray01($strConteudo, 
	$tipoRetorno, 
	$strMarcador = "", 
	$strTabela = "", 
	$nomeCampoRetorno = "")
	{
		$strRetorno = "";
		$countArray = 0;
		//tipoRetorno: 1 - última parte do array | 2 - contagem (,) (exclusão de vetores vazios) | 3 - separação por vírgula (,) e retorno em HTML (div) | 4 - retirar valores em branco (,) | 11 - primeira parte do array (?)
		
		
		//1 - última parte do array
        //----------------------
		///*
		if($tipoRetorno == 1)
		{
			$arrStrConteudo = explode("/", $strConteudo);
			
			foreach($arrStrConteudo as $valor)
			{
				//$strRetorno = $arrStrConteudo[$countArray] => $valor;
				$strRetorno = $valor;
				//$countArray++;
			}
		}
		//*/
        //----------------------
		
		
		//2 - contagem
        //----------------------
		///*
		if($tipoRetorno == 2)
		{
			$arrStrConteudo = explode($strMarcador, $strConteudo);
			
			/*
			foreach($arrStrConteudo as $valor)
			{
				//$strRetorno = $arrStrConteudo[$countArray] => $valor;
				//$strRetorno = $valor;
				$countArray++;
				
			}
			*/
			
			//$strRetorno = $countArray;
			//$strRetorno = count($arrStrConteudo);
			$strRetorno = count(array_filter($arrStrConteudo)); //Não conta a variável vazia.
		}
		//*/
        //----------------------


		//3 - retirar valor em branco
        //----------------------
		if($tipoRetorno == 4)
		{
			///*
			$arrStrConteudo = explode($strMarcador, $strConteudo);
			//$arrStrConteudo = explode(",", $strConteudo);
			
			foreach($arrStrConteudo as $valor)
			{
				if($valor <> "")
				{
					$strRetorno = $strRetorno . $valor . ",";
					//echo "strRetorno=" . $strRetorno . "<br/>";
				}
			}
			
			//Tratamento de array.
			if($strRetorno <> "")
			{
				$strRetorno = Funcoes::IdsFormatar01($strRetorno);
			}
			//*/
			
			/*funcionando.
			$arrStrConteudo = explode($strMarcador, $strConteudo);
			for($countArray3 = 0; $countArray3 < count($arrStrConteudo); $countArray3++)
			{
				if($arrStrConteudo[$countArray3] <> "")
				{
					//$strRetorno = $strRetorno . $arrStrConteudo[$countArray3] . ",";
					$strRetorno = $strRetorno . $arrStrConteudo[$countArray3] . $strMarcador;
				}
				//echo "arrStrConteudo[]=" . $arrStrConteudo[$countArray3] . "<br/>";
			}
			//Tratamento de array.
			if($strRetorno <> "")
			{
				$strRetorno = Funcoes::IdsFormatar01($strRetorno);
			}
			*/
			
		}
        //----------------------

		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retornar uma determinada parte do array para funções de scroll.
	//**************************************************************************************
	function ConteudoRetornoArrayScroll01($strConteudo, $strValorAtual, $tipoRetorno, $strMarcador)
	{
		$strRetorno = "";
		$countArray = 0;
		$countArrayValorAtual = 0;
		//tipoRetorno: 1 - primeiro valor | 2 - último valor | 3 - valor anterior | 4 - valor próximo
	
		//$arrStrConteudo = explode("/", $strConteudo);
		$arrStrConteudo = explode($strMarcador, $strConteudo);
	
	
		//Primeiro Valor.
		//----------------------
		if($tipoRetorno == 1)
		{
			/*
			foreach($arrStrConteudo as $valor)
			{
				//$strRetorno = $arrStrConteudo[$countArray] => $valor;
				$strRetorno = $valor;
				//$countArray++;
			}
			*/
			for($countArray = 0; $countArray < count($arrStrConteudo);$countArray++)
			{
				//echo "arrStrConteudo=" . $arrStrConteudo[$countArray] . "<br/>";
	
				if($countArray == 0)
				{
					$strRetorno = $arrStrConteudo[$countArray];
				}
			}
		}
		//----------------------
	
	
		//Último Valor.
		//----------------------
		if($tipoRetorno == 2)
		{
			for($countArray = 0; $countArray < count($arrStrConteudo);$countArray++)
			{
				//echo "arrStrConteudo=" . $arrStrConteudo[$countArray] . "<br/>";
	
				$strRetorno = $arrStrConteudo[$countArray];
			}
		}
		//----------------------
	
	
		//Anterior Valor.
		//----------------------
		if($tipoRetorno == 3)
		{
			//Primeiro loop para definir a posição do array a ser retornado.
			for($countArray = 0; $countArray < count($arrStrConteudo);$countArray++)
			{
				if($arrStrConteudo[$countArray] == $strValorAtual)
				{
					if($countArray <> 0)
					{
						$countArrayValorAtual = $countArray;
						$countArrayRetorno = $countArrayValorAtual - 1;
					}else{
						$countArrayRetorno = 0;
					}
				}
				//echo "arrStrConteudo=" . $arrStrConteudo[$countArray] . "<br/>";
			}
	
			//Segundo loop para definir a variável de retorno.
			for($countArray = 0; $countArray < count($arrStrConteudo);$countArray++)
			{
				if($countArrayRetorno == $countArray)
				{
					$strRetorno = $arrStrConteudo[$countArray];
				}
			}
		}
		//----------------------
	
	
		//Próximo Valor.
		//----------------------
		if($tipoRetorno == 4)
		{
			for($countArray = 0; $countArray < count($arrStrConteudo);$countArray++)
			{
				if($arrStrConteudo[$countArray] == $strValorAtual)
				{
					$countArrayValorAtual = $countArray;
					$countArrayRetorno = $countArrayValorAtual + 1;
				}
				//echo "arrStrConteudo=" . $arrStrConteudo[$countArray] . "<br/>";
	
				if($countArrayRetorno > count($arrStrConteudo)) //Mecanismo de segurança para não buscar um array maior que a quantidade existente.
				{
					$strRetorno = $strValorAtual;
				}else{
					if($countArrayRetorno == $countArray)
					{
						$strRetorno = $arrStrConteudo[$countArray];
					}
				}
	
			}
		}
		//----------------------
	
	
		return $strRetorno;
	}
	//**************************************************************************************	
	
	
	//Função para gravar valores monetários formatados.
	//**************************************************************************************
	function FormatarValorGravar($conteudo)
	{
		//$strRetorno = "";
		$strRetorno = $conteudo;
		
		$strRetorno = str_replace(".", "", $strRetorno);
		$strRetorno = str_replace(",", "", $strRetorno);
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
    //Função para calcular porcentagem de valores.
    //**************************************************************************************
	function ConversaoPorcentagem($valorTotal, $valorParcial, $formatoRetorno = "")
	{
		//formatoRetorno: 2 - 2 casas decimais
		
		$strReturn = "";
		
		if($valorTotal <> "" && $valorParcial <> "")
		{
			$dValorTotal = $valorTotal; //converter para double
			$dValorParcial = $valorParcial; //converter para double
			$dPercentual = 0;
			
			$dPercentual = 100 / $dValorTotal * $dValorParcial;
			
			if($formatoRetorno <> "")
			{
				//Tratametno decimais.
				$strReturn = number_format((float)$dPercentual, (int)$formatoRetorno, '.', '');
			}else{
				$strReturn = $dPercentual;
			}
			
		}
		
		return $strReturn;
	}
    //**************************************************************************************


	//Retirar caractéres não numéricos.
	//**************************************************************************************
	function SomenteNum($strNumero)
	{
		//$strRetorno = "";
		$strRetorno = preg_replace("/\D+/", "", $strNumero);
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Retirar caractéres especiais.
	//**************************************************************************************
	function RemoverCaracteresEspeciais($conteudo)
	{
		//$strRetorno = str_replace(' ', '-', $conteudo); // Substituir espaços por hífens.
		$strRetorno = str_replace(' ', '', $conteudo); //Remover espaços.
		$strRetorno = str_replace('-', '', $strRetorno); //Remover hífens.
		$strRetorno = preg_replace('/-+/', '', $strRetorno); //Remover hífens múltiplos.
		$strRetorno = preg_replace('/[^A-Za-z0-9\-]/', '', $strRetorno); // Remover caractéres especiais.	
		
		return $strRetorno; 	
	}
	//**************************************************************************************
	
	
	//CEP - Máscara de leitura.
	//**************************************************************************************
	function FormatarCEPLer($strNumeroCEP)
	{
		$strRetorno = "";
		
		if($strNumeroCEP <> "")
		{
			//Retirar qualquer caractérer não numérico.
			$strNumeroCEP = Funcoes::SomenteNum($strNumeroCEP);
			
			if(strlen($strNumeroCEP) == 8) //Verificar se quantidade de números que sobrou é igual ao número correto de composição de CNPJ.
			{
				$strRetorno = substr($strNumeroCEP, 0, 2) . "." .  substr($strNumeroCEP, 2, 3) . "-" . substr($strNumeroCEP, 5, 3);
			}else{
				$strRetorno = $strNumeroCEP;
			}
			
		}
		
		return $strRetorno;
	}
	//**************************************************************************************

	
	//CPF - Máscara de leitura.
	//**************************************************************************************
	//Ref: http://blog.clares.com.br/php-mascara-cnpj-cpf-data-e-qualquer-outra-coisa/
	function FormatarCPFLer($strNumeroCPF)
	{
		$strRetorno = "";
		
		if($strNumeroCPF <> "")
		{
			//Retirar qualquer caractérer não numérico.
			$strNumeroCPF = Funcoes::SomenteNum($strNumeroCPF);
			
			if(strlen($strNumeroCPF) == 11) //Verificar se quantidade de números que sobrou é igual ao número correto de composição de CPF.
			{
				$strRetorno = substr($strNumeroCPF, 0, 3) . "." . substr($strNumeroCPF, 3, 3) . "." . substr($strNumeroCPF, 6, 3) . "-" . substr($strNumeroCPF, 9, 2);
			}else{
				$strRetorno = $strNumeroCPF;
			}
			
		}
		
		return $strRetorno;
	}
	//**************************************************************************************


	//CNPJ - Máscara de leitura.
	//**************************************************************************************
	function FormatarCNPJLer($strNumeroCNPJ)
	{
		$strRetorno = "";
		
		if($strNumeroCNPJ <> "")
		{
			//Retirar qualquer caractérer não numérico.
			$strNumeroCNPJ = Funcoes::SomenteNum($strNumeroCNPJ);
			
			if(strlen($strNumeroCNPJ) == 14) //Verificar se quantidade de números que sobrou é igual ao número correto de composição de CNPJ.
			{
				$strRetorno = substr($strNumeroCNPJ, 0, 2) . "." . substr($strNumeroCNPJ, 2, 3) . "." . substr($strNumeroCNPJ, 5, 3) . "/" . substr($strNumeroCNPJ, 8, 4) . "-" . substr($strNumeroCNPJ, 12, 2);
			}else{
				$strRetorno = $strNumeroCNPJ;
			}
			
		}
		
		return $strRetorno;
	}
	//**************************************************************************************


	//Função para seleção de página de destino e nome de variável.
	//**************************************************************************************
	function CategoriaPaginaSelect($tipoCategoria, $infoRetorno)
	{
		//infoRetorno: 1 - paginaLink | 2 - variavalDestino | 3 - paginaLinkSistema | 4 - variavalDestinoSistema | 5 - nome da função do sistema | 11 - paginaLinkAdm | 12 - variavelDestinoAdm
		

		//Variáveis.
		//----------------------
		$strRetorno = "";
		
		$paginaLink = "";
		$paginaLinkSistema = "";
		$variavalDestino = "";
		$variavalDestinoSistema = "";
		$paginaLinkAdm = "";
		$variavelDestinoAdm = "";
		//----------------------
		
		
		//Obs: modificar variável de destino para "parent" também.
		if($tipoCategoria == 1){
			$paginaLink = "SiteConteudo.php";
			$variavalDestino = "idParentConteudo";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentConteudo";
			
			$paginaLinkAdm = "SiteAdmConteudo.php";
			$variavelDestinoAdm = "idParentConteudo";
		}
		if($tipoCategoria == 2){
			$paginaLink = "SiteProdutosIndice.php";
			$variavalDestino = "idParentProdutos";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentProdutos";
			
			$paginaLinkAdm = "SiteAdmProdutosIndice.php";
			$variavelDestinoAdm = "idParentProdutos";
		}
		if($tipoCategoria == 3){
			$paginaLink = "SitePublicacoesNoticiasIndice.php";
			$variavalDestino = "idParentPublicacoes";
			$variavalDestinoSistema = "idParentPublicacoes";
			
			$paginaLinkAdm = "SiteAdmPublicacoesNoticiasIndice.php";
			$variavelDestinoAdm = "idParentPublicacoes";
		}
		if($tipoCategoria == 4){
			$paginaLink = "SitePublicacoesNoticiasIndice.php";
			$variavalDestino = "idParentPublicacoes";
			$variavalDestinoSistema = "idParentPublicacoes";
			
			$paginaLinkAdm = "SiteAdmPublicacoesNoticiasIndice.php";
			$variavelDestinoAdm = "idParentPublicacoes";
		}
		if($tipoCategoria == 5){
			$paginaLink = "SitePublicacoesNoticiasIndice.php";
			$variavalDestino = "idParentPublicacoes";
			$variavalDestinoSistema = "idParentPublicacoes";
			
			$paginaLinkAdm = "SiteAdmPublicacoesNoticiasIndice.php";
			$variavelDestinoAdm = "idParentPublicacoes";
		}
		if($tipoCategoria == 6){
			$paginaLink = "SitePublicacoesNoticiasIndice.php";
			$variavalDestino = "idParentPublicacoes";
			$variavalDestinoSistema = "idParentPublicacoes";
			
			$paginaLinkAdm = "SiteAdmPublicacoesNoticiasIndice.php";
			$variavelDestinoAdm = "idParentPublicacoes";
		}
		if($tipoCategoria == 7){
			$paginaLink = "SiteEnquetesIndice.php";
			$variavalDestino = "idParentEnquetes";
			$variavalDestinoSistema = "idParentEnquetes";
			
			$paginaLinkAdm = "SiteAdmEnquetesIndice.php";
			$variavelDestinoAdm = "idParentEnquetes";
		}
		if($tipoCategoria == 11){
			$paginaLink = "SiteAfiliacoesIndice.php";
			$variavalDestino = "idParentAfiliacoes";
			$variavalDestinoSistema = "idParentAfiliacoes";
			
			$paginaLinkAdm = "SiteAdmAfiliacoesIndice.php";
			$variavelDestinoAdm = "idParentAfiliacoes";
		}
		if($tipoCategoria == 12){
			$paginaLink = "SiteFormulariosIndice.php";
			$variavalDestino = "idTbFormularios";
			$variavalDestinoSistema = "idParentFormularios";
			
			$paginaLinkAdm = "SiteAdmFormulariosIndice.php";
			$variavelDestinoAdm = "idParentFormularios";
		}
		if($tipoCategoria == 13){
			$paginaLink = "SiteCadastroIndice.php";
			$variavalDestino = "idParentCadastro";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentCadastro";
			
			$paginaLinkAdm = "SiteAdmCadastroIndice.php";
			$variavelDestinoAdm = "idParentCadastro";
		}
		if($tipoCategoria == 15){
			$paginaLink = "SiteForumTopicos.php";
			$variavalDestino = "idTbForumTopicos";
			$variavalDestinoSistema = "idParent";
			
			$paginaLinkAdm = "SiteAdmForumTopicos.php";
			$variavelDestinoAdm = "idParent";
		}
		if($tipoCategoria == 17){
			$paginaLink = "SiteEnquetesIndice.php";
			$variavalDestino = "idParentEnquetes";
			$variavalDestinoSistema = "idParentEnquetes";
			
			$paginaLinkAdm = "SiteAdmEnquetesIndice.php";
			$variavelDestinoAdm = "idParentEnquetes";
		}
		if($tipoCategoria == 18){
			$paginaLink = "SiteVeiculosIndice.php";
			$variavalDestino = "idParentVeiculos";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentVeiculos";
			
			$paginaLinkAdm = "SiteAdmVeiculosIndice.php";
			$variavelDestinoAdm = "idParentVeiculos";
		}
		if($tipoCategoria == 19){
			$paginaLink = "SiteCadastroIndice.php";
			$variavalDestino = "idParentCadastro";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentCadastro";
			
			$paginaLinkAdm = "SiteAdmCadastroIndice.php";
			$variavelDestinoAdm = "idParentCadastro";
		}
		if($tipoCategoria == 20){
			$paginaLink = "SiteNewsletterIndice.php";
			$variavalDestino = "idParentNewsletter";
			$variavalDestinoSistema = "idParentNewsletter";
			
			$paginaLinkAdm = "SiteAdmNewsletterIndice.php";
			$variavelDestinoAdm = "idParentNewsletter";
		}
		if($tipoCategoria == 21){
			$paginaLink = "SiteFluxoIndice.php";
			$variavalDestino = "idParentFluxo";
			$variavalDestinoSistema = "idParentFluxo";
			
			$paginaLinkAdm = "SiteAdmFluxoIndice.php";
			$variavelDestinoAdm = "idParentFluxo";
		}
		if($tipoCategoria == 22){
			$paginaLink = "SiteBannersIndice.php";
			$variavalDestino = "idParentBanners";
			$variavalDestinoSistema = "idParentBanners";
			
			$paginaLinkAdm = "SiteAdmBannersIndice.php";
			$variavelDestinoAdm = "idParentBanners";
		}
		if($tipoCategoria == 26){
			$paginaLink = "SitePaginasIndice.php";
			$variavalDestino = "idParentPaginas";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentPaginas";
			
			$paginaLinkAdm = "SiteAdmPaginasIndice.php";
			$variavelDestinoAdm = "idParentPaginas";
		}
		if($tipoCategoria == 29){
			$paginaLink = "SiteProcessosIndice.php";
			$variavalDestino = "idParentProcessos";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentProcessos";
			
			$paginaLinkAdm = "SiteAdmProcessosIndice.php";
			$variavelDestinoAdm = "idParentProcessos";
		}
		if($tipoCategoria == 63){
			$paginaLink = "SiteArquivosIndice.php";
			$variavalDestino = "idParent";
			$variavalDestinoSistema = "idParent";
			
			$paginaLinkAdm = "SiteAdmArquivosIndice.php";
			$variavelDestinoAdm = "idParent";
		}
		if($tipoCategoria == 80){
			$paginaLink = "SiteTurmasIndice.php";
			$variavalDestino = "idParentTurmas";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentTurmas";
			
			$paginaLinkAdm = "SiteAdmTurmasIndice.php";
			$variavelDestinoAdm = "idParentTurmas";
		}
		if($tipoCategoria == 81){
			$paginaLink = "SiteModulosIndice.php";
			$variavalDestino = "idParentModulos";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentModulos";
			
			$paginaLinkAdm = "SiteAdmModulosIndice.php";
			$variavelDestinoAdm = "idParentModulos";
		}
		if($tipoCategoria == 82){
			$paginaLink = "SiteAulasIndice.php";
			$variavalDestino = "idParentAulas";
			//$variavalDestinoSistema = "idParent";
			$variavalDestinoSistema = "idParentAulas";
			
			$paginaLinkAdm = "SiteAdmAulasIndice.php";
			$variavelDestinoAdm = "idParentAulas";
		}


		//Definição da variável de retorno.
		//----------------------
		if($infoRetorno == 1)
		{
			$strRetorno = $paginaLink;
		}
		
		if($infoRetorno == 2)
		{
			$strRetorno = $variavalDestino;
		}
		
		if($infoRetorno == 3)
		{
			for ($countTipoCategoria = 0; $countTipoCategoria < count($GLOBALS['arrTipoCategoriaConfigIndice']); ++$countTipoCategoria) 
			{ 
				if($GLOBALS['arrTipoCategoriaConfigIndice'][$countTipoCategoria] == $tipoCategoria)
				{
					$strRetorno = $GLOBALS['arrTipoCategoriaConfigPagina'][$countTipoCategoria];
				}
			}
		}
		
		if($infoRetorno == 4)
		{
			$strRetorno = $variavalDestinoSistema;
		}

		if($infoRetorno == 5)
		{
			for ($countTipoCategoria = 0; $countTipoCategoria < count($GLOBALS['arrTipoCategoriaConfigIndice']); ++$countTipoCategoria) 
			{ 
				if($GLOBALS['arrTipoCategoriaConfigIndice'][$countTipoCategoria] == $tipoCategoria)
				{
					$strRetorno = $GLOBALS['arrTipoCategoriaConfigNome'][$countTipoCategoria];
				}
			}
		}
		
		if($infoRetorno == 11)
		{
			$strRetorno = $paginaLinkAdm;
		}
		if($infoRetorno == 12)
		{
			$strRetorno = $variavelDestinoAdm;
		}
		//----------------------
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retorno de campo de designação de nome.
	//**************************************************************************************
	function GetCadastroTitulo($strNome, $strRazaoSocial, $strNomeFantasia, $metodoRetorno)
	{
		//metodoRetorno: 1 - dados (preferencia 01) | 2 - nome do campo  (preferencia 01)
		$strRetorno = "";
		$strDados = "";
		$strCampo = "";

		//Ordem de preferência
		if(empty($strNomeFantasia))
		{
			if(empty($strRazaoSocial))
			{
				$strDados = $strNome;
				$strCampo = "nome";
			}else{
				$strDados = $strRazaoSocial;
				$strCampo = "razao_social";
			}
		}else{
			$strDados = $strNomeFantasia;
			$strCampo = "nome_fantasia";
		}
		
		if($metodoRetorno == 1)
		{
			$strRetorno = $strDados;
		}else{
			$strRetorno = $strCampo;
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para verificar o tamanho de um string e decidir se torna "visible" algum elemento.
	//**************************************************************************************
	function ConteudoVerificarTamanho01($strConteudo, $limiteCaracteres)
	{
		//Definição de algumas variáveis.
		$strRetorno = false;
		
		if(strlen($strConteudo) <= $limiteCaracteres)
		{
			$strRetorno = false;
		}else{
			$strRetorno = true;
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para converter em quilos.
	//**************************************************************************************
	function ValorConverterPeso($strValor, $strOperacao)
	{
		//strOperacao: 1 - converter gramas para kilo | 11 - arredondar valor de gramas para cima (cálculo de frete)
		
		
		//Variáveis.
		$strRetorno = "0";
		
		
		//Converter gramas para kilo.
		//----------------------
		if($strOperacao == 1)
		{
			$strRetorno = $strValor / 1000;
		}
		//----------------------
		
		
		//Arredondar valor de gramas para cima (cálculo de frete).
		//----------------------
		if($strOperacao == 11)
		{

		}
		//----------------------
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para acertar formatação de variável com ids.
	//**************************************************************************************
	function IdsFormatar01($strIds)
	{
		//$strRetorno = "";
		$strRetorno = $strIds;
		
		if($strRetorno <> "")
		{
			if(substr($strRetorno, (strlen($strRetorno) - 1), 1) == ",")
			{
				$strRetorno = substr($strRetorno, 0, strlen($strRetorno) - 1);
			}elseif(substr($strRetorno, (strlen($strRetorno) - 2), 2) == ", ")
			{
				$strRetorno = substr($strRetorno, 0, strlen($strRetorno) - 2);
			}
		}
	
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para acertar formatação de variável com arrays e separadores diversos.
	//**************************************************************************************
	function IdsFormatar02($strIds, $strSeparador = ",")
	{
		//$strRetorno = "";
		$strRetorno = $strIds;
		$strSeparadorTamanho = strlen($strSeparador);
		
		if($strRetorno <> "")
		{
			if (substr($strRetorno, (strlen($strRetorno) - $strSeparadorTamanho), $strSeparadorTamanho) == $strSeparador)
			{
				$strRetorno = substr($strRetorno, 0, strlen($strRetorno) - $strSeparadorTamanho);
			}
		}
	
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Preenchimentos de controles de horário.
	//**************************************************************************************
	function HorarioFill01($strHorario, $tipoPreenchimento)
	{
        //strHorario: h - horário | m - minuto | s - segundo
        //Criação de variáveis.
        //----------------------
		$strRetorno = array();
		
        $countHora = 0;
        $countMinuto = 0;
        //----------------------
		
        //Intervalo convencional.
        //----------------------
		if($tipoPreenchimento == 1)
		{
			//Hora.
			if($strHorario == "h")
			{
				while($countHora < 24)
				{
					$strRetorno[$countHora] = $countHora;
					$countHora++;
				}
			}
			
			//Minuto.
			if($strHorario == "m")
			{
				while($countMinuto < 60)
				{
					$strRetorno[$countMinuto] = $countMinuto;
					$countMinuto++;
				}
			}
		}
        //----------------------
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para limitar número de caracteres.
	//**************************************************************************************
	function LimitadorCatecteres($strConteudo, $strNumeroCaracteres)
	{
		$strRetorno = $strConteudo;
		
		if(strlen($strRetorno) > $strNumeroCaracteres)
		{
			$strRetorno = substr($strRetorno, 0, $strNumeroCaracteres);
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para remover tags HTML
	//**************************************************************************************
	function RemoverHTML01($strHTML)
	{
		$strRetorno = $strHTML;
		
		$strRetorno = strip_tags($strRetorno);
		
		return $strRetorno;
	}
	//**************************************************************************************


	//Funções de diagramação.
	
	//Função de alinhamento texto.
	//**************************************************************************************
	function AlinhamentoTexto($strParametro)
	{
		$strAlinhamento = "";
		
		if($strParametro == "1")
		{
			$strAlinhamento = "right";
		}
		if($strParametro == "2")
		{
			$strAlinhamento = "center";
		}
		if($strParametro == "3")
		{
			$strAlinhamento = "left";
		}
		if($strParametro == "4")
		{
			$strAlinhamento = "justify";
		}
		
		return $strAlinhamento;
	}
	//**************************************************************************************

	
	//Função para resgatar querystring longos.
	//**************************************************************************************
	function GetQueryString($queryString)
	{
		//Variáveis.
		$strRetorno = "";
		$arrQueryString = array();
		$serverQueryString = $_SERVER['QUERY_STRING'];
		
		
		$arrServerQueryString = explode("&", $serverQueryString);
		
		for($countArrayQueryString = 0; $countArrayQueryString < count($arrServerQueryString); $countArrayQueryString++)
		{
			$arrPar = array();
			$arrPar = explode("=", $arrServerQueryString[$countArrayQueryString]);
			if($arrPar[0] == "includeCharts_chartDadosMultiplos")
			{
				//echo "QUERY_STRING-includeCharts_chartDadosMultiplos=" . $arrPar[1];
				//$includeCharts_chartDadosMultiplos = urldecode($arrPar[1]);
				//$includeCharts_chartDadosMultiplos = $arrPar[1];
				$strRetorno = urldecode($arrPar[1]);
			}
			
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função para retornar informação entre duas referências de posicionamento.
	//**************************************************************************************
	function DadosPesquisa($dadosPesquisa, $infoRefInicial, $infoRefFinal, $tipoRetorno, $parametrosEspeciais = array())
	{
		//$tipoRetorno: 1 - retorno da informação entre infoRefInicial e infoRefFinal.
		
		//Variáveis.
		$strReturn = "";
		
		$posInfoRefInicial = strpos($dadosPesquisa, $infoRefInicial) + strlen($infoRefInicial);
		$posInfoRefFinal = strpos($dadosPesquisa, $infoRefFinal) - $posInfoRefInicial;
		
		
		//Separação da informação.
		if($posInfoRefInicial !== false)
		{
			$strReturn = trim(substr($dadosPesquisa, $posInfoRefInicial, $posInfoRefFinal));
		}
		
		
		//Verificação de erro - debug.
		//echo "posInfoRefInicial=" . $posInfoRefInicial . "<br/>";
		//echo "posInfoRefFinal=" . $posInfoRefFinal . "<br/>";

		
		return $strReturn;
	}
	//**************************************************************************************
	
	
	//Função para retornar o IP do Visitante.
	//**************************************************************************************
	function GetVisitanteIP01()
	{
		//Variáveis.
		$strReturn = "";
		
		$strReturn = $_SERVER['HTTP_CLIENT_IP'];
		if($strReturn == "")
		{
			$strReturn = $_SERVER['HTTP_X_FORWARDED_FOR'];
			if($strReturn == "")
			{
				$strReturn = $_SERVER['REMOTE_ADDR'];
			}
		}
		
		return $strReturn;
	}
	//**************************************************************************************
	
	
	//Função para retornar a localização do visitante baseado no IP.
	//**************************************************************************************
	function VisitanteLocalizacao01($strVisitanteIP, $tipoRetorno)
	{
		//tipoRetorno: paisCodigo | pais | codigoRegiao | estado | cidade | latitude | longitude | latitude,longitude
		
		
		//Variáveis.
		//----------------------
		$strReturn = "";
		
		$visitanteIPRetorno = "";
		$visitantePaisCodigoRetorno = "";
		$visitantePaisRetorno = "";
		$visitanteCodigoRegiaoRetorno = "";
		$visitanteEstadoRetorno = "";
		$visitanteCidadeRetorno = "";
		$visitanteLatitudeRetorno = "";
		$visitanteLongitudeRetorno = "";
		//----------------------
		
		
		//WS http://ip-api.com/json/2
		//----------------------
		if($GLOBALS['configLocalizacaoVisitante'] == 2)
		{
			$wsLocalizacaoURL = "http://ip-api.com/json/" . $strVisitanteIP;
			
			
			//Curl.
			$cJsonLocalizacao = curl_init();
			curl_setopt($cJsonLocalizacao, CURLOPT_URL, $wsLocalizacaoURL);
			curl_setopt($cJsonLocalizacao, CURLOPT_RETURNTRANSFER, 1);
			$conteudoCJsonLocalizacao = curl_exec($cJsonLocalizacao);
			curl_close($cJsonLocalizacao);
			
			
			//Json Parse.
			$jsonLocalizacao = json_decode($conteudoCJsonLocalizacao);
			
			
			//Definição de valores.
			$visitanteIPRetorno = "";
			$visitantePaisCodigoRetorno = $jsonLocalizacao->countryCode;
			$visitantePaisRetorno = $jsonLocalizacao->country;
			$visitanteCodigoRegiaoRetorno = "";
			$visitanteEstadoRetorno = $jsonLocalizacao->region;
			$visitanteCidadeRetorno = $jsonLocalizacao->city;;
			$visitanteLatitudeRetorno = $jsonLocalizacao->lat;
			$visitanteLongitudeRetorno = $jsonLocalizacao->lon;
		}
		//----------------------

		
		if($tipoRetorno = "paisCodigo")
		{
			$strReturn = $visitantePaisCodigoRetorno;
		}
		if($tipoRetorno = "pais")
		{
			$strReturn = $visitantePaisRetorno;
		}
		if($tipoRetorno = "codigoRegiao")
		{
			$strReturn = $visitanteCodigoRegiaoRetorno;
		}
		if($tipoRetorno = "estado")
		{
			$strReturn = $visitanteEstadoRetorno;
		}
		if($tipoRetorno = "cidade")
		{
			$strReturn = $visitanteCidadeRetorno;
		}
		if($tipoRetorno = "latitude")
		{
			$strReturn = $visitanteLatitudeRetorno;
		}
		if($tipoRetorno = "longitude")
		{
			$strReturn = $visitanteLongitudeRetorno;
		}
		if($tipoRetorno = "latitude,longitude")
		{
			$strReturn = $visitanteLatitudeRetorno . "," . $visitanteLongitudeRetorno;
		}
		
		return $strReturn;
	}
	//**************************************************************************************

	
		//Função para remover acentos.
		function removeAccents($string){
			return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'))), ' '));
		}

}