<?php
//Criação de id temporária.
CookiesFuncoes::IdTbCadastroTemporario_CookieCriar();

//Debug.
//Limpar todos os cookies.
/*
if(CookiesFuncoes::CookieLogin_Logoff() == true)
{
	//Sucesso.
}
*/
//CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario"); //Exclusão de cookie id temporário.


//Layout site.
//**************************************************************************************
$masterPageSiteSelect = $_GET["masterPageSiteSelect"];
if($masterPageSiteSelect == "")
{
	$masterPageSiteSelect = $_POST["masterPageSiteSelect"];
}

if($masterPageSiteSelect == "")
{
	$masterPageSiteSelect = "LayoutSitePrincipal.php";
}

$pageSite->LayoutSite = $masterPageSiteSelect;
//**************************************************************************************
?>