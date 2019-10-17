<?php
//Definição de variáveis.
$StrTabela = $includeNavegacao_strTabela;
$StrClassificacao = $includeNavegacao_strClassificacao;
$ArrParametrosPesquisa = $includeNavegacao_arrParametrosPesquisa;
$RegistroAtual = $includeNavegacao_registroAtual;

$TipoNavegacao = $includeNavegacao_tipoNavegacao; //1 - simples (edição / detalhes)
if(empty($TipoNavegacao))
{
	$TipoNavegacao = 1;
}
$PaginaDestino = $includeNavegacao_paginaDestino;
$VariavelDestino = $includeNavegacao_variavelDestino;


//Definição de valores.
$arrIdsRegistrosNavegacao = DbFuncoes::GetCampoGenerico11($StrTabela, 
														"id", 
														$ArrParametrosPesquisa, 
														$StrClassificacao, 
														"", 
														3, 
														array("idRegistroAtual" => $RegistroAtual));
														
$idRegistroProximo = $arrIdsRegistrosNavegacao["idRegistroProximoRetorno"];
$idRegistroAnterior = $arrIdsRegistrosNavegacao["idRegistroAnteriorRetorno"];
$idRegistroPrimeiro = $arrIdsRegistrosNavegacao["idRegistroPrimeiroRetorno"];
$idRegistroUltimo = $arrIdsRegistrosNavegacao["idRegistroUltimoRetorno"];
$idsRegistrosCount = $arrIdsRegistrosNavegacao["idsRegistrosCount"];
$idRegistroAtualPosicao = $arrIdsRegistrosNavegacao["idRegistroAtualPosicao"];


//Verificação de erro - debug.
//echo "TipoLogin=" . $TipoLogin . "<br />";
//echo "OrigemLogin=" . $OrigemLogin . "<br />"; 
//echo "paginaRetornoLogin=" . $paginaRetornoLogin . "<br />";
//echo "idRetornoLogin=" . $idRetornoLogin . "<br />";


//array("id_tb_categorias;" . $tbVeiculosIdTbCategorias . ";i")
//array("id_tb_categorias;" . $tbVeiculosIdTbCategorias . ";i", "ativacao;1;i")
//Definição de valores.
//$idRegistroAtual = $tbVeiculosId;
$idRegistroAtual = $arrIdsRegistrosNavegacao["idRegistroAtualRetorno"];
/*
$idRegistroProximo = DbFuncoes::GetCampoGenerico11("tb_veiculos", 
													"id", 
													array("id_tb_categorias;" . $tbVeiculosIdTbCategorias . ";i"), 
													"", 
													"", 
													3, 
													array("idRegistroAtual" => $tbVeiculosId));
*/


//Debug.
/*
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

//array("id_tb_categorias;" . $tbVeiculosIdTbCategorias . ";i")
echo "Todos Registros=" . DbFuncoes::GetCampoGenerico11($StrTabela, 
														"id", 
														$ArrParametrosPesquisa, 
														"", 
														"", 
														1); . "<br/>";
													
echo "idRegistroAtual=" . $idRegistroAtual . "<br/>";
echo "idRegistroProximo=" . $idRegistroProximo . "<br/>";
echo "idRegistroAnterior=" . $idRegistroAnterior . "<br/>";
echo "idRegistroPrimeiro=" . $idRegistroPrimeiro . "<br/>";
echo "idRegistroUltimo=" . $idRegistroUltimo . "<br/>";
echo "idsRegistrosCount=" . $idsRegistrosCount . "<br/>";
echo "idRegistroAtualPosicao=" . $idRegistroAtualPosicao . "<br/>";

echo "idRegistroUltimo=";
echo print_r($arrIdsRegistrosNavegacao);
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
*/
?>


<?php //Diagramação 1.?>
<?php //**************************************************************************************?>
<?php if($TipoNavegacao == "1"){ ?>
	<div style="position: relative; display: inline-block; vertical-align: top;">
		<a href="<?php echo $PaginaDestino;?>?<?php echo $VariavelDestino;?>=<?php echo $idRegistroPrimeiro;?>" class="AdmLinks01">
			<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
            <img src="img/btoNavegacaoPrimeiro.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>" border="0" />
		</a>
	</div>
	<div style="position: relative; display: inline-block; vertical-align: top;">
		<a href="<?php echo $PaginaDestino;?>?<?php echo $VariavelDestino;?>=<?php echo $idRegistroAnterior;?>" class="AdmLinks01">
			<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
            <img src="img/btoNavegacaoAnterior.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>" border="0" />
		</a>
	</div>
	<div style="position: relative; display: inline-block; height: 20px; line-height: 20px; border: 1px solid #000; padding: 0px 5px 0px 5px; vertical-align: top;">
		<?php echo $idRegistroAtualPosicao; ?> / <?php echo $idsRegistrosCount; ?>
	</div>
	<div style="position: relative; display: inline-block; vertical-align: top;">
		<a href="<?php echo $PaginaDestino;?>?<?php echo $VariavelDestino;?>=<?php echo $idRegistroProximo;?>" class="AdmLinks01">
			<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
            <img src="img/btoNavegacaoProximo.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>" border="0" />
		</a>
	</div>
	<div style="position: relative; display: inline-block; vertical-align: top;">
		<a href="<?php echo $PaginaDestino;?>?<?php echo $VariavelDestino;?>=<?php echo $idRegistroUltimo;?>" class="AdmLinks01">
			<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
            <img src="img/btoNavegacaoUltimo.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>" border="0" />
		</a>
	</div>
<?php } ?>
<?php //**************************************************************************************?>