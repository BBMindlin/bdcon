<?php
class VideoFuncoes
{
    //Função para montar HTML e exibir o vídeo na página.
    //**************************************************************************************
    function VideoExibirHTML($nomeArquivo, $videoLargura, $videoAltura, $videoTitulo)
	{
		$strReturn = "";
		
		if ($videoLargura == "")
		{
			$videoLargura = $GLOBALS['configTamanhoVideoW'];
		} 
		
		if ($videoAltura == "")
		{
			$videoAltura = $GLOBALS['configTamanhoVideoH'];
		} 
		
		if ($videoTitulo == "")
		{
			$videoTitulo = "Vídeo";
		}  
		
		//Código padrão (somente navegadores novos).
		$strReturn .= "<object id='MediaPlayer' width='" . $videoLargura . "' height='" . $videoAltura . "' classid='CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95' standby='Aguarde, enquanto carregando...' type='application/x-oleobject'>";
		$strReturn .= "<param name='FileName' value='" . $GLOBALS['configDiretorioArquivos'] . "/" . $nomeArquivo . "?variavelCache=" . date("s") . "'>";
		$strReturn .= "<param name='autostart' value='false'>";
		$strReturn .= "<param name='ShowControls' value='true'>";
		$strReturn .= "<param name='ShowStatusBar' value='false'>";
		$strReturn .= "<param name='ShowStatusBar' value='false'>";
		$strReturn .= "<param name='ShowDisplay' value='false'>";
		$strReturn .= "<embed type='application/x-mplayer2' src='" . $GLOBALS['configDiretorioArquivos'] . "/" . $nomeArquivo . "?variavelCache=" . date("s") . "' name='MediaPlayer' width='" . $videoLargura . "' height='" . $videoAltura . "' showcontrols='1' ahowstatusBar='0' showdisplay='0' autostart='0'> </embed>";

		return $strReturn;
	}
    //**************************************************************************************

}