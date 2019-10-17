<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de qual botão foi acionado.
$btoAcionado = "";
//if(isset($_POST['btoSelecionar'])) 
if(isset($_POST['btoSelecionar_x'])) 
{
	$btoAcionado = "btoSelecionar";
}else{
	
}
//if(isset($_POST['btoLog01'])) 
if(isset($_POST['btoLog01_x'])) 
{
	$btoAcionado = "btoLog01";
}else{
	
}


/*
foreach($_POST as $stuff)
{
    if(is_array($stuff))
	{
        foreach($stuff as $thing) {
            //echo $thing;
			echo "thing=" . $thing . "<br />";
        }
    } else {
        //echo $stuff;
		echo "stuff=" . $stuff . "<br />";
    }
}
*/

/*
foreach ($_POST['idsRegistrosExcluir'] as $value)
{
    //echo $value;
	echo "value=" . $value . "<br />";
}
*/

/*
for ($i = 0; $i < $_POST['idsRegistrosExcluir']; $i++)
{
	//echo $_POST['idsRegistrosExcluir'][$i];
	echo "idsRegistrosExcluir=" . $_POST['idsRegistrosExcluir'][$i] . "<br />";
}
*/


//Variáveis.
$strTabela = $_POST["strTabela"];

$idParentCategorias = $_POST["idParentCategorias"];
$idParentCategoriasRaiz = $_POST["idParentCategoriasRaiz"];
$tipoCategoria = $_POST["tipoCategoria"];

$idParentConteudo = $_POST["idParentConteudo"];
$idParentProdutos = $_POST["idParentProdutos"];
$idParentVeiculos = $_POST["idParentVeiculos"];

$idParentPublicacoes = $_POST["idParentPublicacoes"];
$tipoPublicacao = $_POST["tipoPublicacao"];

$idParent = $_POST["idParent"];
$tipoArquivo = $_POST["tipoArquivo"];
$detalhe01 = $_POST["detalhe01"];
$detalhe02 = $_POST["detalhe02"];

$idParentCadastro = $_POST["idParentCadastro"];
$idParentAfiliacoes = $_POST["idParentAfiliacoes"];

$idParentFormularios = $_POST["idParentFormularios"];
$idTbFormularios = $_POST["idTbFormularios"];
$idTbFormulariosCampos = $_POST["idTbFormulariosCampos"];

$idTbNewsletter = $_POST["idTbNewsletter"];
$idParentNewsletter = $_POST["idParentNewsletter"];
$idTbNewsletterEmailsAvulsoGrupos = $_POST["idTbNewsletterEmailsAvulsoGrupos"];

$idParentEnquetes = $_POST["idParentEnquetes"];
$idTbEnquetes = $_POST["idTbEnquetes"];
$tipoEnquete = $_POST["tipoEnquete"];

$idParentBanners = $_POST["idParentBanners"];
$idTbBanners = $_POST["idTbBanners"];
$idTbForumTopicos = $_POST["idTbForumTopicos"];
$idParentPaginas = $_POST["idParentPaginas"];
$idParentProcessos = $_POST["idParentProcessos"];
$idParentTurmas = $_POST["idParentTurmas"];
$idParentModulos = $_POST["idParentModulos"];
$idTbAulas = $_POST["idTbAulas"];
$idParentAulas = $_POST["idParentAulas"];

$arrIdsRegistrosExcluir = $_POST["idsRegistrosExcluir"];
$arrIdsRegistrosSelecionar = $_POST["idsRegistrosSelecionar"];
$countRegistrosExcluidos = 0;

$idTbCadastro = $_POST["idTbCadastro"];
$idTbCadastroCliente = $_POST["idTbCadastroCliente"];
$idTbCadastroUsuario = $_POST["idTbCadastroUsuario"];

$idCePedidos = $_POST["idCePedidos"];
$idCeOrcamentos = $_POST["idCeOrcamentos"];

$idItem = $_POST["idItem"];

$paginaRetorno = $_POST["paginaRetorno"];
$variavelRetorno = $_POST["variavelRetorno"];
$idRegistroRetorno = $_POST["idRegistroRetorno"];
$masterPageSelect = $_POST["masterPageSelect"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_POST["paginacaoNumero"];
$palavraChave = $_POST["palavraChave"];


//Tratamento de array de imagens.
//**************************************************************************************
$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
$nomeCampoArquivo = "";

//tb_categorias
//----------
if($strTabela == "tb_categorias")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemCategoria'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_conteudo
//----------
if($strTabela == "tb_conteudo")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemConteudo'];
	}
	$nomeCampoArquivo = "arquivo";
}
//----------


//tb_veiculos
//----------
if($strTabela == "tb_veiculos")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemVeiculos'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_arquivos
//----------
if($strTabela == "tb_arquivos")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemArquivos'];
	}
	$nomeCampoArquivo = "arquivo";
}
//----------


//tb_cadastro
//----------
if($strTabela == "tb_cadastro")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemCadastro'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_cadastro_enderecos
//----------
if($strTabela == "tb_cadastro_enderecos")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemCadastroEnderecos'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_banners_arquivos
//----------
if($strTabela == "tb_banners_arquivos")
{
	/*
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemAfiliacoes'];
	}
	*/
	$nomeCampoArquivo = "arquivo";
}
//----------


//tb_publicacoes
//----------
if($strTabela == "tb_publicacoes")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemPublicacoes'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_produtos
//----------
if($strTabela == "tb_produtos")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemProdutos'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_afiliacoes
//----------
if($strTabela == "tb_afiliacoes")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemAfiliacoes'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_formularios_campos_opcoes
//----------
if($strTabela == "tb_formularios_campos_opcoes")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemFormulariosCamposOpcoes'];
	}
	$nomeCampoArquivo = "arquivo";
}
//----------


//tb_enquetes
//----------
if($strTabela == "tb_enquetes")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemEnquetes'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_enquetes_opcoes
//----------
if($strTabela == "tb_enquetes_opcoes")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemEnquetesOpcoes'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_paginas
//----------
if($strTabela == "tb_paginas")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemPaginas'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//ce_orcamentos_itens
//----------
//if($strTabela == "ce_orcamentos_itens")
//{
	//if($GLOBALS['ativacaoImagensPadrao'] == 0)
	//{
		//$arrImagemTamanhos = $GLOBALS['arrImagemOrcamentosItens'];
	//}
	//$nomeCampoArquivo = "imagem";
//}
//----------


//tb_turmas
//----------
if($strTabela == "tb_turmas")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemTurmas'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_modulos
//----------
if($strTabela == "tb_modulos")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemModulos'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//tb_aulas
//----------
if($strTabela == "tb_aulas")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemAulas'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------
//**************************************************************************************


//Verificação de erro.
/*
echo "strTabela=" . $strTabela . "<br />";
echo "idParentCategorias=" . $idParentCategorias . "<br />";
echo "id_tb_cadastro_usuario=" . $id_tb_cadastro_usuario . "<br />";
echo "paginaRetorno=" . $paginaRetorno . "<br />";
echo "arrIdsRegistrosExcluir=" . $arrIdsRegistrosExcluir . "<br />";

//Funcionando.
if(!empty($_POST['idsRegistrosExcluir'])) {
    foreach($_POST['idsRegistrosExcluir'] as $check) {
		//echo $check; //echoes the value set in the HTML form for each checked checkbox.
					 //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
					 //in your case, it would echo whatever $row['Report ID'] is equivalent to.
		echo "check=" . $check . "<br />";
    }
}
*/


//Exclusão.
//**************************************************************************************
if(!empty($arrIdsRegistrosExcluir))
{
	foreach($arrIdsRegistrosExcluir as $idRegistro)
	{
		$nomeArquivo = DbFuncoes::GetCampoGenerico01($idRegistro, $strTabela, $nomeCampoArquivo);
		//$value = $value * 2;
		//echo "value=" . $value . "<br />";
		//echo "exclusão=" . ExcluirRegistrosGenerico01($value, $strTabela, "id") . "<br />";
		//echo "exclusão=" . DbExcluir::ExcluirRegistrosGenerico01($idRegistro, $strTabela, "id") . "<br />";
		if(DbExcluir::ExcluirRegistrosGenerico01($idRegistro, $strTabela, "id"))
		{
			Arquivo::ExcluirArquivos($nomeArquivo, $arrImagemTamanhos); //Exclusão de arquivos.
			
			$countRegistrosExcluidos = $countRegistrosExcluidos + 1;
			$mensagemSucesso = $countRegistrosExcluidos . " " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus10");
		}else{
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1");
		}
	}
}
//**************************************************************************************


//Seleção.
//**************************************************************************************
if($btoAcionado == "btoSelecionar") //Verificação do botão acionado.
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($idItem, 
										"tb_itens_relacao_registros", 
										"id_item",
										"tipo_categoria", 
										$tipoCategoria);
										
	if(!empty($arrIdsRegistrosSelecionar))
	{
		//Loop pela seleção.
		foreach($arrIdsRegistrosSelecionar as $idRegistro)
		{
			//Valor.
			$tbItensRelacaoRegistrosValor = "";
			if($_POST["valor_" . $idRegistro] <> "")
			{
				$tbItensRelacaoRegistrosValor = $_POST["valor_" . $idRegistro];
			}
			
			
			/**/
			//if(DbFuncoes::ItensRelacaoRegistroInsert($idItem, $idRegistro, $tipoCategoria, $strTabela) == true)
			if(DbFuncoes::ItensRelacaoRegistroInsert($idItem, $idRegistro, $tipoCategoria, $strTabela, $tbItensRelacaoRegistrosValor) == true)
			{
				$countRegistrosExcluidos = $countRegistrosExcluidos + 1;
				$mensagemSucesso = $countRegistrosExcluidos . " " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			}else{
				$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
			}
			
			//ItensRelacaoRegistroInsert($idItem, $idRegistro, $tipoCategoria, $strTabela)
			
			
			//Verificação de erro.
			/*
			echo "idRegistro=" . $idRegistro . "<br />";
			echo "idItem=" . $idItem . "<br />";
			echo "tipoCategoria=" . $tipoCategoria . "<br />";
			echo "strTabela=" . $strTabela . "<br />";
			echo "tbItensRelacaoRegistrosValor=" . $tbItensRelacaoRegistrosValor . "<br />";
			
			echo "idsRegistrosSelecionar=";
			print_r($idsRegistrosSelecionar);
			echo "<br />";
			
			echo "arrIdsRegistrosSelecionar=";
			print_r($arrIdsRegistrosSelecionar);
			echo "<br />";
			*/
		}
	}else{
		$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
}
//**************************************************************************************


//Log 01.
//**************************************************************************************
if($btoAcionado == "btoLog01") //Verificação do botão acionado.
{
	$arrIdsLogFiltroGenerico01 = $_POST["idsLogFiltroGenerico01"];
	$arrIdsLogFiltroGenerico02 = $_POST["idsLogFiltroGenerico02"];
	$arrIdsLogFiltroGenerico03 = $_POST["idsLogFiltroGenerico03"];
	$arrIdsLogFiltroGenerico04 = $_POST["idsLogFiltroGenerico04"];
	$arrIdsLogFiltroGenerico05 = $_POST["idsLogFiltroGenerico05"];
	$arrIdsLogFiltroGenerico06 = $_POST["idsLogFiltroGenerico06"];
	$arrIdsLogFiltroGenerico07 = $_POST["idsLogFiltroGenerico07"];
	$arrIdsLogFiltroGenerico08 = $_POST["idsLogFiltroGenerico08"];
	$arrIdsLogFiltroGenerico09 = $_POST["idsLogFiltroGenerico09"];
	$arrIdsLogFiltroGenerico10 = $_POST["idsLogFiltroGenerico10"];
	
	
	//Limpeza dos registros anteriores.
	//----------------------
	$idsLog = DbFuncoes::GetCampoGenerico06("tb_log", 
												"id", 
												"id_registro", 
												$idTbAulas, 
												"", 
												"", 
												1, 
												"", 
												"", 
												"", 
												"", 
												"log_tipo", 
												"21");
	if($idsLog <> "")
	{
		$arrIdsLog = explode(",", $idsLog);
		for($countArray = 0; $countArray < count($arrIdsLog); $countArray++)
		{
			//Limpeza dos complementos.
			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"12");
												
			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"13");
												
			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"14");
												
			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"15");

			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"16");

			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"17");

			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"18");

			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"19");

			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"20");

			DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], 
												"tb_log_relacao_complemento", 
												"id_tb_log",
												"tipo_complemento", 
												"21");
		}
	}
	
	//Limpeza do log.
	for($countArray = 0; $countArray < count($arrIdsLog); $countArray++)
	{
		DbExcluir::ExcluirRegistrosGenerico02($arrIdsLog[$countArray], "tb_log", "id");
	}
	//----------------------
	
	
	//Filtro Genérico 01.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico01))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico01 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "12", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}

				
				//Verificação de erro - debug.
				//echo "idRegistro=" . $idRegistro . "<br />";
				//echo "idTbAulas=" . $idTbAulas . "<br />";
				//echo "idRegistroIdLogComplemento=" . $idRegistroIdLogComplemento . "<br />";
				//echo "idRegistroIdCadastro=" . $idRegistroIdCadastro . "<br />";
				//echo "idRegistroLogTipo=" . $idRegistroLogTipo . "<br />";
				//echo "idRegistroTipoCategoria=" . $idRegistroTipoCategoria . "<br />";
				//echo "idRegistroStrTabela=" . $idRegistroStrTabela . "<br />";
				//echo "logInsertResultado=" . $logInsertResultado . "<br />";
				//echo "idTbLog=" . $idTbLog . "<br />";
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------


	//Filtro Genérico 02.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico02))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico02 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "13", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------
	
	
	//Filtro Genérico 03.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico03))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico03 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "14", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------
	
	
	//Filtro Genérico 04.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico04))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico04 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "15", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------
	
	
	//Filtro Genérico 05.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico05))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico05 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "16", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------
	
	
	//Filtro Genérico 06.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico06))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico06 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "17", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------
	
	
	//Filtro Genérico 07.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico07))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico07 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "18", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------
	
	
	//Filtro Genérico 08.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico08))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico08 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "19", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------
	
	
	//Filtro Genérico 09.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico09))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico09 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "20", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------
	
	
	//Filtro Genérico 10.
	//----------------------
	if(!empty($arrIdsLogFiltroGenerico10))
	{
		
		//Loop pela seleção.
		foreach($arrIdsLogFiltroGenerico10 as $idRegistro)
		{
			if($idRegistro <> "")
			{
				//Definição de variáveis.
				$arrIdRegistro = explode(";", $idRegistro);
				$idRegistroIdLogComplemento = $arrIdRegistro[0];
				$idRegistroIdCadastro = $arrIdRegistro[1];
				$idRegistroLogTipo = $arrIdRegistro[2];
				$idRegistroTipoCategoria = $arrIdRegistro[3];
				$idRegistroStrTabela = $arrIdRegistro[4];
				
				
				//Inclusão de log.
				$logInsertResultado = DbInsert::LogInsert($idTbAulas, 
										$idRegistroIdCadastro, 
										$idRegistroStrTabela, 
										$idRegistroLogTipo, 
										"", 
										"", 
										"", 
										"", 
										"", 
										"", 
										"");
										
				if($logInsertResultado == true)
				{
					//Resgate id do log.
					$idTbLog = DbFuncoes::GetCampoGenerico06("tb_log", 
															"id", 
															"id_registro", 
															$idTbAulas, 
															"", 
															"", 
															2, 
															"", 
															"", 
															"id_tb_cadastro", 
															$idRegistroIdCadastro, 
															"log_tipo", 
															$idRegistroLogTipo);
					
					//Gravação da relação complemento.
					DbFuncoes::FiltrosGenericosGravar01($idTbLog, $idRegistroIdLogComplemento, "21", "tb_log_relacao_complemento", "id_tb_log", "id_tb_log_complemento");
					
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
				}else{
					$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23e");
				}
			}
		}
	}else{
		//$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	//----------------------
}
//exit();
//**************************************************************************************


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$queryRetorno = "";
$queryRetorno .= "paginacaoNumero=" . $paginacaoNumero;
if($idParent <> "")
{
	$queryRetorno .= "&idParent=" . $idParent;
}
if($idParentCategorias <> "")
{
	$queryRetorno .= "&idParentCategorias=" . $idParentCategorias;
}
if($idParentCategoriasRaiz <> "")
{
	$queryRetorno .= "&idParentCategoriasRaiz=" . $idParentCategoriasRaiz;
}
if($tipoCategoria <> "")
{
	$queryRetorno .= "&tipoCategoria=" . $tipoCategoria;
}
if($idParentConteudo <> "")
{
	$queryRetorno .= "&idParentConteudo=" . $idParentConteudo;
}
if($idParentProdutos <> "")
{
	$queryRetorno .= "&idParentProdutos=" . $idParentProdutos;
}
if($idParentVeiculos <> "")
{
	$queryRetorno .= "&idParentVeiculos=" . $idParentVeiculos;
}
if($idParentPublicacoes <> "")
{
	$queryRetorno .= "&idParentPublicacoes=" . $idParentPublicacoes;
}
if($tipoPublicacao <> "")
{
	$queryRetorno .= "&tipoPublicacao=" . $tipoPublicacao;
}
if($idParentCadastro <> "")
{
	$queryRetorno .= "&idParentCadastro=" . $idParentCadastro;
}
if($idParentAfiliacoes <> "")
{
	$queryRetorno .= "&idParentAfiliacoes=" . $idParentAfiliacoes;
}
if($idParentFormularios <> "")
{
	$queryRetorno .= "&idParentFormularios=" . $idParentFormularios;
}
if($idTbFormularios <> "")
{
	$queryRetorno .= "&idTbFormularios=" . $idTbFormularios;
}
if($idTbFormulariosCampos <> "")
{
	$queryRetorno .= "&idTbFormulariosCampos=" . $idTbFormulariosCampos;
}
if($idTbNewsletter <> "")
{
	$queryRetorno .= "&idTbNewsletter=" . $idTbNewsletter;
}
if($idParentNewsletter <> "")
{
	$queryRetorno .= "&idParentNewsletter=" . $idParentNewsletter;
}
if($idTbNewsletterEmailsAvulsoGrupos <> "")
{
	$queryRetorno .= "&idTbNewsletterEmailsAvulsoGrupos=" . $idTbNewsletterEmailsAvulsoGrupos;
}
if($idParentEnquetes <> "")
{
	$queryRetorno .= "&idParentEnquetes=" . $idParentEnquetes;
}
if($idTbEnquetes <> "")
{
	$queryRetorno .= "&idTbEnquetes=" . $idTbEnquetes;
}
if($tipoEnquete <> "")
{
	$queryRetorno .= "&tipoEnquete=" . $tipoEnquete;
}
if($idParentBanners <> "")
{
	$queryRetorno .= "&idParentBanners=" . $idParentBanners;
}
if($idTbBanners <> "")
{
	$queryRetorno .= "&idTbBanners=" . $idTbBanners;
}
if($idTbForumTopicos <> "")
{
	$queryRetorno .= "&idTbForumTopicos=" . $idTbForumTopicos;
}
if($idParentPaginas <> "")
{
	$queryRetorno .= "&idParentPaginas=" . $idParentPaginas;
}
if($idParentProcessos <> "")
{
	$queryRetorno .= "&idParentProcessos=" . $idParentProcessos;
}
if($idParentTurmas <> "")
{
	$queryRetorno .= "&idParentTurmas=" . $idParentTurmas;
}
if($idParentModulos <> "")
{
	$queryRetorno .= "&idParentModulos=" . $idParentModulos;
}
if($idParentAulas <> "")
{
	$queryRetorno .= "&idParentAulas=" . $idParentAulas;
}
if($idTbAulas <> "")
{
	$queryRetorno .= "&idTbAulas=" . $idTbAulas;
}
if($idTbCadastro <> "")
{
	$queryRetorno .= "&idTbCadastro=" . $idTbCadastro;
}
if($idTbCadastro1 <> "")
{
	$queryRetorno .= "&idTbCadastro1=" . $idTbCadastro1;
}
if($idTbCadastroCliente <> "")
{
	$queryRetorno .= "&idTbCadastroCliente=" . $idTbCadastroCliente;
}
if($idTbCadastroUsuario <> "")
{
	$queryRetorno .= "&idTbCadastroUsuario=" . $idTbCadastroUsuario;
}
if($idCePedidos <> "")
{
	$queryRetorno .= "&idCePedidos=" . $idCePedidos;
}
if($idItem <> "")
{
	$queryRetorno .= "&idItem=" . $idItem;
}
if($idCeOrcamentos <> "")
{
	$queryRetorno .= "&idCeOrcamentos=" . $idCeOrcamentos;
}
if($idCeOrcamentosItens <> "")
{
	$queryRetorno .= "&idCeOrcamentosItens=" . $idCeOrcamentosItens;
}
if($tipoRelatorio <> "")
{
	$queryRetorno .= "&tipoRelatorio=" . $tipoRelatorio;
}
if($dataInicial <> "")
{
	$queryRetorno .= "&dataInicial=" . $dataInicial;
}
if($dataFinal <> "")
{
	$queryRetorno .= "&dataFinal=" . $dataFinal;
}
if($palavraChave <> "")
{
	$queryRetorno .= "&palavraChave=" . $palavraChave;
}
if($detalhe01 <> "")
{
	$queryRetorno .= "&detalhe01=" . $detalhe01;
}
if($detalhe02 <> "")
{
	$queryRetorno .= "&detalhe02=" . $detalhe02;
}
if($mensagemSucesso <> "")
{
	$queryRetorno .= "&mensagemSucesso=" . $mensagemSucesso;
}
if($mensagemErro <> "")
{
	$queryRetorno .= "&mensagemErro=" . $mensagemErro;
}
if($masterPageSelect <> "")
{
	$queryRetorno .= "&masterPageSelect=" . $masterPageSelect;
}

$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" . $queryRetorno;

/*
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentCategorias=" . $idParentCategorias .
"&tipoCategoria=" . $tipoCategoria .
"&idParentConteudo=" . $idParentConteudo .
"&idParentProdutos=" . $idParentProdutos .
"&idParentPublicacoes=" . $idParentPublicacoes .
"&tipoPublicacao=" . $tipoPublicacao .
"&idParent=" . $idParent .
"&tipoArquivo=" . $tipoArquivo .
"&idParentCadastro=" . $idParentCadastro .
"&idParentAfiliacoes=" . $idParentAfiliacoes .
"&idParentFormularios=" . $idParentFormularios .
"&idTbFormularios=" . $idTbFormularios .
"&idTbFormulariosCampos=" . $idTbFormulariosCampos .
"&idParentEnquetes=" . $idParentEnquetes .
"&idTbEnquetes=" . $idTbEnquetes .
"&tipoEnquete=" . $tipoEnquete .
"&idParentBanners=" . $idParentBanners .
"&idTbBanners=" . $idTbBanners .
"&idParentPaginas=" . $idParentPaginas .
"&idParentProcessos=" . $idParentProcessos .
"&idParentTurmas=" . $idParentTurmas .
"&idParentModulos=" . $idParentModulos .
"&idTbAulas=" . $idTbAulas .
"&idParentAulas=" . $idParentAulas .
"&idTbCadastro=" . $idTbCadastro .
"&idTbCadastroCliente=" . $idTbCadastroCliente .
"&idTbCadastroUsuario=" . $idTbCadastroUsuario .
"&idCePedidos=" . $idCePedidos .
"&idCeOrcamentos=" . $idCeOrcamentos .
"&idItem=" . $idItem .
"&paginacaoNumero=" . $paginacaoNumero .
"&palavraChave=" . $palavraChave .
"&masterPageSelect=" . $masterPageSelect .
"&detalhe01=" . $detalhe01 .
"&detalhe02=" . $detalhe02 .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;
*/

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