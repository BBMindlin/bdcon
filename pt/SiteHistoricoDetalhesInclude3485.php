        <!--Informações Principais-->
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInformacoesPrincipais"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoDataHistorico; ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarHistoricoData1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData1; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoData2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData2; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoData3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData3; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoData4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData4; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoData5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData5; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro1_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro2_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro3_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoVinculo4'] == 1){ ?>
            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo4Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro4_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo5'] == 1){ ?>
            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo5Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro5_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo6'] == 1){ ?>
            <tr style="display: none;">
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo6Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro6_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico72'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "83"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
		</table>
        
        
        
        <!--Estado de Conservação-->
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoEstadoConservacao"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro1_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico62'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "73"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico63'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "74"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc51'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc51'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC51;?>
                    </div>
                </td>
            </tr>
            <?php } ?>


            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "61"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico51'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "62"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico58'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "69"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico59'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "70"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico61'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "72"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc49'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC49;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc56'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc56'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC56;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
		</table>
        
        
        <!--Tratamento-->
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTratamento"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro2_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "14"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC3;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "16"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC4;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc59'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc59'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC59;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc60'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc60'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC60;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC5;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc53'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc53'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC53;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "27"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "28"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc17'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC17;?>
                    </div>
                </td>
            </tr>
            <?php } ?>           


            <?php if($GLOBALS['habilitarHistoricoIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC6;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "29"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "30"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc18'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC18;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "31"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc19'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC19;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "32"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc20'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC20;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc21'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC21;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
		</table>


        <!--Acondicionamento-->
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoAcondicionamento"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro3_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico60'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "71"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico64'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "75"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc55'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc55'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC55;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc54'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc54'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC54;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico65'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "76"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico71'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "82"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico66'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "77"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico67'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "78"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico68'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "79"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico70'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "81"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc57'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc57'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC57;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc58'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc58'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC58;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
		</table>


        <table class="AdmTabelaCampos02" style="display: none;">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoAssunto"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoAssunto; ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistorico"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoHistorico; ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "12"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "13"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            

            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico56'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "67"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico57'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "68"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            
            
            
            

            
            
            
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico69'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "80"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico73'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "84"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico74'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "85"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico75'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "86"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico76'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "87"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico77'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "88"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico78'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "89"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico79'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "90"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico80'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "91"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                       <?php echo $tbHistoricoIC1;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC2;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
        
        
            
            
        
        
        
        
        
            
            
        
        
        
            
            
        
        
        
            
            
        
        
        
            
            
        
        
        
            
            
        
        
        
            
            
        
            <?php if($GLOBALS['habilitarHistoricoIc43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc43'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC43;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
        
            
            
        
        
        
            <?php if($GLOBALS['habilitarHistoricoIc50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc50'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC50;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoIc52'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc52'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC52;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
        
        
            
            <?php if($GLOBALS['habilitarCadastroHistoricoUsuario'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoCadastroUsuario"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastroUsuario_print;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
            <tr<?php if(idTbHistoricoStatusSelect <> ""){ ?> style="display: none;"<?php } ?>>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbHistoricoStatus_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
