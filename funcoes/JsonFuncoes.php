<?php
class JsonFuncoes
{
	//Função para retornar informações sobre registros por API.
	//**************************************************************************************
	function GetDados_API02($_apiURL, 
	$strTipoAPI, 
	$tipoRetorno, 
	$opcoesComplementares = array())
	{
        //strTipoAPI: youtube | googleMapsGeocoding | googleMatrix | sistema | generico
			//ex googleMatrix: JsonFuncoes::GetDados_API02("", "googleMatrix", "arrayDistanciasDuracaoMultiplos", array('distanciaOrigem'=>'-23.4960943,-46.6078504','distanciaDestino'=>'-23.539976,-46.697317|-23.546480,-46.690799', 'distanciaModalidade'=>'walking')))
        //strTipoDados (youtube): viewCount (YouTube) | title | description
        //strTipoDados (googleMapsGeocoding): locationLatLng
		//tipoRetorno (sistema): jsonStringCompleto
		//tipoRetorno (googleMatrix): array (completo) | arrayDistanciasDuracaoMultiplos (múltiplos destinos) | arrayDistanciasDuracao (somente um destino)
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = "";
		//----------


		//Sistema
		//----------
		if($strTipoAPI == "sistema")
		{
			if($tipoRetorno == "jsonStringCompleto")
			{
				$curlObj = curl_init();
				curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curlObj, CURLOPT_URL, $_apiURL);
				$curlResultado = curl_exec($curlObj);
				curl_close($curlObj);
				
				//$jsonObj = json_decode($curlResultado);
				
				
				$strRetorno = $curlResultado;
				
				//Verificação de erro - debug.
				//echo "flag_jsonStringCompleto=" . "true" . "<br/>";
				
			}
		}
		//----------
		
		
		//GeoLocalização por IP do visitante.
		//----------
		if($strTipoAPI == "geolocalizacao_ip")
		{
			//Variáveis.
			$ipVisitante = $_SERVER['REMOTE_ADDR'];
			$apiURLConsulta = "http://ip-api.com/json/" . $ipVisitante; 
			//http://ip-api.com/json/ (unban: http://ip-api.com/docs/unban | compra: https://signup.ip-api.com/ | telefone: +40 730596625 | detalhes da empresa: http://listings.findthecompany.com/l/262566105/Artia-International-Srl)
			//http://freegeoip.net/json/ (menos preciso) (teste: http://freegeoip.net/json/177.68.50.5 | site: https://freegeoip.net/?q=177.68.50.5)
			$cidadeVisitante = "";
			$estadoVisitante = "";
			
			
			//Curl.
			$cJsonLocalizacao = curl_init();
			curl_setopt($cJsonLocalizacao, CURLOPT_URL, $apiURLConsulta);
			curl_setopt($cJsonLocalizacao, CURLOPT_RETURNTRANSFER, 1);
			$conteudoCJsonLocalizacao = curl_exec($cJsonLocalizacao);
			//$curlError = curl_error($curlObj); //verificação de erro.
			//$curlInfo = curl_getinfo($curlObj); //verificação de erro.
			curl_close($cJsonLocalizacao);
			
			
			//Json Parse.
			$jsonLocalizacao = json_decode($conteudoCJsonLocalizacao);
			
			
			//Definição de valores.
			$cidadeVisitante = $jsonLocalizacao->city;
			$estadoVisitante = $jsonLocalizacao->region;
		}
		//----------
		
		
		//GeoLocalização por IP do visitante.
		//----------
		if($strTipoAPI == "geolocalizacao_ip")
		{
			//Variáveis.
			$ipVisitante = $_SERVER['REMOTE_ADDR'];
			$apiURLConsulta = "http://ip-api.com/json/" . $ipVisitante; 
			//http://ip-api.com/json/ (unban: http://ip-api.com/docs/unban | compra: https://signup.ip-api.com/ | telefone: +40 730596625 | detalhes da empresa: http://listings.findthecompany.com/l/262566105/Artia-International-Srl)
			//http://freegeoip.net/json/ (menos preciso) (teste: http://freegeoip.net/json/177.68.50.5 | site: https://freegeoip.net/?q=177.68.50.5)
			$cidadeVisitante = "";
			$estadoVisitante = "";
			
			
			//Curl.
			$cJsonLocalizacao = curl_init();
			curl_setopt($cJsonLocalizacao, CURLOPT_URL, $apiURLConsulta);
			curl_setopt($cJsonLocalizacao, CURLOPT_RETURNTRANSFER, 1);
			$conteudoCJsonLocalizacao = curl_exec($cJsonLocalizacao);
			//$curlError = curl_error($curlObj); //verificação de erro.
			//$curlInfo = curl_getinfo($curlObj); //verificação de erro.
			curl_close($cJsonLocalizacao);
			
			
			//Json Parse.
			$jsonLocalizacao = json_decode($conteudoCJsonLocalizacao);
			
			
			//Definição de valores.
			$cidadeVisitante = $jsonLocalizacao->city;
			$estadoVisitante = $jsonLocalizacao->region;
		}
		//----------
		
		
		//Google Matrix - cálculo de distância.
		//----------
		//ref: https://developers.google.com/maps/documentation/distance-matrix/intro
		if($strTipoAPI == "googleMatrix")
		{
			//Variáveis.
			$apiURLConsulta = "https://maps.googleapis.com/maps/api/distancematrix/json?key=" . $GLOBALS['configAPIGoogleMatrix'];
			$apiURLConsulta .= "&units=metric"; //metric | imperial
			$apiURLConsulta .= "&language=pt-BR"; //https://developers.google.com/maps/faq#languagesupport
			if($opcoesComplementares["distanciaModalidade"] <> "")
			{
				$apiURLConsulta .= "&mode=" . $opcoesComplementares["distanciaModalidade"]; //driving | walking | bicycling | transit - requer plano especial (transit_mode - opcional)
			}else{
				$apiURLConsulta .= "&mode=driving"; //driving | walking | bicycling | transit - requer plano especial (transit_mode - opcional)
			}
			//$apiURLConsulta .= "&transit_mode=bus"; //bus | subway | train | tram | rail
			//$apiURLConsulta .= "&traffic_model=best_guess"; //pessimistic | optimistic
			//$apiURLConsulta .= "&avoid=tolls"; //tolls | highways | ferries | indoor
			//$apiURLConsulta .= "&origins=-23.4960943,-46.6078504"; //Debug.
			$apiURLConsulta .= "&origins=" . urlencode($opcoesComplementares["distanciaOrigem"]);
			//$apiURLConsulta .= "&destinations=-23.539976,-46.697317|-23.546480,-46.690799";
			$apiURLConsulta .= "&destinations="  . urlencode($opcoesComplementares["distanciaDestino"]);
			
			
			//Curl.
			/*
			$cJsonDistancia = curl_init();
			curl_setopt($cJsonDistancia, CURLOPT_URL, $apiURLConsulta);
			curl_setopt($cJsonDistancia, CURLOPT_RETURNTRANSFER, 1);
			$conteudoCJsonDistancia = curl_exec($cJsonDistancia);
			//$curlError = curl_error($curlObj); //verificação de erro.
			//$curlInfo = curl_getinfo($curlObj); //verificação de erro.
			curl_close($cJsonDistancia);
			
			
			//Json Parse.
			$jsonDistancia = json_decode($conteudoCJsonDistancia);
			*/
			
			
			$cJsonDistancia = curl_init();
			curl_setopt($cJsonDistancia, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($cJsonDistancia, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($cJsonDistancia, CURLOPT_URL, $apiURLConsulta);
			$curlResultado = curl_exec($cJsonDistancia);
			curl_close($cJsonDistancia);
			
			
			//Tratamento de dados e monstagem do retorno.
			//Json Parse.
			$jsonDistancia = json_decode($curlResultado);
			
			//Conversão de json string para array.
			$arrCurlResultado = json_decode($curlResultado, true);
			
			$arrDistanciasDuracao = array();
			
			
			//Retornos.
			
			//Array com informações completas.
			if($tipoRetorno == "array")
			{
				$strRetorno	= $arrCurlResultado;
			}
			
			//Array com informações resumidas (distância e duração) para destino único.
			if($tipoRetorno == "arrayDistanciasDuracao")
			{
				//for($countArray = 0; $arrCurlResultado
				
				for($countRows = 0; $countRows < count($arrCurlResultado['rows']); $countRows++) //loop pelos 'rows'
				{
					//echo "rows=";
					//var_dump($arrCurlResultado['rows'][$countRows]);
					//echo "<br/>";
					
					//for($countElements = 0;$countElements < count($arrCurlResultado['rows'][$countRows]['elements']); $countElements++) //loop pelos 'elements'
					//{
						//echo "elements=";
						//var_dump($arrCurlResultado['rows'][$countRows]['elements'][$countElements]);
						//echo "<br/>";
						
						//echo "distance=" . $arrCurlResultado['rows'][$countRows]['elements'][$countElements]['distance']['text'];
						//echo "<br/>";
						
						//Inclusão dos valores no array.
						$arrDistanciasDuracao['distancia'] .= $arrCurlResultado['rows'][0]['elements'][0]['distance']['text'];
						$arrDistanciasDuracao['duracao'] .= $arrCurlResultado['rows'][0]['elements'][0]['duration']['text'];
					//}
					
				}
				
				$strRetorno	= $arrDistanciasDuracao;
			}
			
			//Array com informações resumidas (distância e duração) para destinos múltiplos.
			if($tipoRetorno == "arrayDistanciasDuracaoMultiplos")
			{
				//for($countArray = 0; $arrCurlResultado
				
				for($countRows = 0; $countRows < count($arrCurlResultado['rows']); $countRows++) //loop pelos 'rows'
				{
					//echo "rows=";
					//var_dump($arrCurlResultado['rows'][$countRows]);
					//echo "<br/>";
					
					for($countElements = 0;$countElements < count($arrCurlResultado['rows'][$countRows]['elements']); $countElements++) //loop pelos 'elements'
					{
						//echo "elements=";
						//var_dump($arrCurlResultado['rows'][$countRows]['elements'][$countElements]);
						//echo "<br/>";
						
						//echo "distance=" . $arrCurlResultado['rows'][$countRows]['elements'][$countElements]['distance']['text'];
						//echo "<br/>";
						
						//Inclusão dos valores no array.
						$arrDistanciasDuracao[$countElements]['distancia'] .= $arrCurlResultado['rows'][$countRows]['elements'][$countElements]['distance']['text'];
						$arrDistanciasDuracao[$countElements]['duracao'] .= $arrCurlResultado['rows'][$countRows]['elements'][$countElements]['duration']['text'];
					}
					
				}
				
				$strRetorno	= $arrDistanciasDuracao;
			}
			
			
			//Debug.
			//$strRetorno = $jsonDistancia;
			//$strRetorno = $apiURLConsulta;
			//$strRetorno = $curlResultado;
			//$strRetorno = $jsonDistancia;
			//$strRetorno = $jsonDistancia->destination_addresses;
			//$strRetorno = $jsonDistancia->rows;
			//$strRetorno = $arrCurlResultado['rows'];
			//$strRetorno = json_decode($curlResultado, true);
		}
		//----------
		
		
		//Genérico.
		//----------
		if($strTipoAPI == "generico")
		{
			if($tipoRetorno == "jsonStringCompleto")
			{
				$curlObj = curl_init();
				curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curlObj, CURLOPT_URL, $_apiURL);
				$curlResultado = curl_exec($curlObj);
				curl_close($curlObj);
				
				//$jsonObj = json_decode($curlResultado);
				
				
				$strRetorno = $curlResultado;
				
				//Verificação de erro - debug.
				//echo "flag_jsonStringCompleto=" . "true" . "<br/>";
				
			}
		}
		//----------


		return $strRetorno;
	}
	//**************************************************************************************

	
	//Função para converter dados dos DB para JSon.
	//**************************************************************************************
	function JSonConverterDados01($strTabela, 
	$arrCamposRetorno, 
	$strClassificacao = "", 
	$strNRegistros = "", 
	$tipoRetorno = 1,
	$ids1Referencia = "", 
	$ids1Valor = "", 
	$strCampoComplementar1Referencia = "", 
	$strCampoComplementar1Valor = "", 
	$strCampoComplementar2Referencia = "", 
	$strCampoComplementar2Valor = "", 
	$strCampoComplementar3Referencia = "", 
	$strCampoComplementar3Valor = "", 
	$arrCampoComplementar = array())
	{
		//Ref:
		//http://www.kodingmadesimple.com/2015/01/convert-mysql-to-json-using-php.html
		//http://nitschinger.at/Handling-JSON-like-a-boss-in-PHP/
		
		//tipoRetorno: 1 - json_encode
		//$arrCampoComplementar: strCampoComplementar4Referencia => strCampoComplementar4Valor, etc
		
		//Criação de algumas variáveis.
		//----------
		$strRetorno = "";
		$arrRetorno = array();
		$strCamposPesquisa = "";
		$strSqlCampoGenericoSelect = "";
		//----------
		
		
		//Montagem dos campos.
		//----------
		/**/
		for($countCampos = 0; $countCampos < count($arrCamposRetorno); $countCampos++)
		{
			$strCamposPesquisa .= $arrCamposRetorno[$countCampos] .  ",";
		}
		//Tratamento da variável para retirar a última vírgula.
		if($strCamposPesquisa <> "")
		{
			$strCamposPesquisa = Funcoes::IdsFormatar01($strCamposPesquisa);
		}	
		//----------
		
	
	
		//Query de pesquisa.
		//----------
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . $strTabela . " ";
		
		
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		$strSqlCampoGenericoSelect .= "SELECT " . Funcoes::ConteudoMascaraGravacao01($strCamposPesquisa) . " FROM " . Funcoes::ConteudoMascaraGravacao01($strTabela) . " ";
		
		
		//$strSqlCampoGenericoSelect .= "SELECT * FROM classificacao ";
		//$strSqlCampoGenericoSelect .= "SELECT * FROM :strTabela "; //Não funciona.
		$strSqlCampoGenericoSelect .= "WHERE id <> 0 ";
		//$strSqlCampoGenericoSelect .= "AND id = :id ";
		
		//$strSqlCampoGenericoSelect .= "WHERE " . Funcoes::ConteudoMascaraGravacao01($nomeCampoReferencia) . " = :strValor ";
		
		if($ids1Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($ids1Referencia) . " IN ( " . Funcoes::ConteudoMascaraGravacao01($ids1Valor) . ") ";
		}
		
		if($strCampoComplementar1Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar1Referencia) . " = :strCampoComplementar1Valor ";
		}
		
		if($strCampoComplementar2Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar2Referencia) . " = :strCampoComplementar2Valor ";
		}
		
		if($strCampoComplementar3Referencia <> "")
		{
			$strSqlCampoGenericoSelect .= "AND " . Funcoes::ConteudoMascaraGravacao01($strCampoComplementar3Referencia) . " = :strCampoComplementar3Valor ";
		}
	
		//$strSqlCampoGenericoSelect .= "WHERE id_registro = :strValor ";
		//$strSqlCampoGenericoSelect .= "WHERE id_registro = 1200 ";
		//echo "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect . "<br />";
		//echo "strValorReferencia=" . $strValorReferencia . "<br />";
		//echo "strCampoComplementar1Valor=" . $strCampoComplementar1Valor . "<br />";
		//$strRetorno .= "strSqlCampoGenericoSelect=" . $strSqlCampoGenericoSelect;
		//----------
		
		
		//Inclusão de parâmetros.
		//----------
		$statementCampoGenericoSelect = $GLOBALS['dbSistemaConPDO']->prepare($strSqlCampoGenericoSelect);
		
		if ($statementCampoGenericoSelect !== false)
		{
			//$statementCampoGenericoSelect->bindParam(':strValor', $strValorReferencia, PDO::PARAM_STR);
			
			if($strCampoUsuarioReferencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoUsuarioValor', $strCampoUsuarioValor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar1Referencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoComplementar1Valor', $strCampoComplementar1Valor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar2Referencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoComplementar2Valor', $strCampoComplementar2Valor, PDO::PARAM_STR);
			}
			
			if($strCampoComplementar2Referencia <> "")
			{
				$statementCampoGenericoSelect->bindParam(':strCampoComplementar3Valor', $strCampoComplementar3Valor, PDO::PARAM_STR);
			}
	
			//$statementTarefasSelect->bindParam(':palavraChave', $palavraChave, PDO::PARAM_STR);
			//$statementTarefasSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
			$statementCampoGenericoSelect->execute();
	
			/*
			$statementCampoGenericoSelect->execute(array(
				"strValor" => $strValorReferencia
			));
			*/
		}
		//----------
	
	
		//Resultado.
		//----------
		//$resultadoCampoGenerico = $statementCampoGenericoSelect->fetchAll();
		$resultadoCampoGenerico = $statementCampoGenericoSelect->fetchAll(PDO::FETCH_ASSOC);
		
		
		
		if(empty($resultadoCampoGenerico))
		{
			//Nenhum resultado encontrado.
		}else{
			
			//json_encode
			if($tipoRetorno == 1)
			{
				$arrRetorno = $resultadoCampoGenerico;
			}

			foreach($resultadoCampoGenerico as $linhaCampoGenerico)
			{
				
				//json_encode
				//if($tipoRetorno == 1)
				//{
					//$arrRetorno[] = $linhaCampoGenerico;
				//}
				
				
				//echo "id=" . $linhaCampoGenerico["id"] . "<br />";
				
				/*
				if($linhaCampoGenerico[$nomeCampoRetorno] === null)
				//if($linhaCampoGenerico["criterio_classificacao"] === null)
				{
					$strRetorno = "";
				}else{
					
					if($tipoRetorno == 1)
					{
						$strRetorno .= $linhaCampoGenerico[$nomeCampoRetorno] . ",";
					}
					if($tipoRetorno == 2)
					{
						$strRetorno = $linhaCampoGenerico[$nomeCampoRetorno];
						//$strRetorno .= $linhaCampoGenerico["criterio_classificacao"];
					}
				}
				*/
				
			}
		}
		//----------
	
	
		//Tratamento da variável para retirar a última vírgula.
		//----------
		/*
		if($tipoRetorno == 1)
		{
			if($strRetorno <> "")
			{
				$strRetorno = substr($strRetorno, -strlen($strRetorno), strlen($strRetorno)-1);
			}
		}
		*/
		//----------
	
	
		//Limpeza de objetos.
		//----------
		unset($strSqlCampoGenericoSelect);
		unset($statementCampoGenericoSelect);
		unset($resultadoCampoGenerico);
		unset($linhaCampoGenerico);
		//----------
		
		
		//Verificação de erro - debug.
		//echo "strCamposPesquisa=" . $strCamposPesquisa . "<br />";
		
		
		//return $strRetorno;
		//json_encode
		if($tipoRetorno == 1)
		{
			return $arrRetorno;
		}
	}
	//**************************************************************************************


	//Função para retornar dados de uma string json.
	//**************************************************************************************
	function JsonDecode01($strJson, $strNodeRetorno, $tipoRetorno)
	{
		//$tipoRetorno: 
		
		//Variáveis.
		//----------
		$strRetorno = "";
		//----------
		
		
		if($strJson <> "")
		{
			//$jdoStrJson = json_decode($strJson, true); //Dados não podem ser lidos com máscara.
			$jdoStrJson = json_decode($strJson); //Sem true, retorna como objeto. Com true, retorna como array.
			
			$strRetorno = $jdoStrJson->{$strNodeRetorno};
		}
		
		
		return $strRetorno;
	}
	//**************************************************************************************
}