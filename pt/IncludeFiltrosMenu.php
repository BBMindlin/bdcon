<?php
//Definição de variáveis.
$TipoDiagramacao = $includeFiltrosMenu_tipoDiagramacao;
$StrTabelaComplemento = $includeFiltrosMenu_strTabelaComplemento;
$TipoComplemento = $includeFiltrosMenu_tipoComplemento; //1 - página de login | 2 - carrinho de compras | 3 - Outros
//TipoDiagramacao: 1 - links convencionais


//Verificação de erro - debug.
//echo "TipoDiagramacao=" . $TipoDiagramacao . "<br />";
//echo "StrTabelaComplemento=" . $StrTabelaComplemento . "<br />";
//echo "TipoComplemento=" . $TipoComplemento . "<br />";
?>


<?php //Diagramação 1.?>
<?php //**************************************************************************************?>
<?php if($TipoDiagramacao == "1"){ ?>
    <div>
		<?php 
            $arrFiltroComplemento = DbFuncoes::FiltrosGenericosFill01($StrTabelaComplemento, $TipoComplemento);
        ?>
        
        <?php 
        for($countArray = 0; $countArray < count($arrFiltroComplemento); $countArray++)
        {
        ?>
            <div>
                <a href="SiteCadastroIndice.php?idsTbCadastroComplemento=<?php echo $arrFiltroComplemento[$countArray][0];?>" class="CategoriasMenuNivel01">
                    <?php echo $arrFiltroComplemento[$countArray][1];?>
                </a>
            </div>
        <?php 
        }
        ?>
    </div>
<?php } ?>
<?php //**************************************************************************************?>
