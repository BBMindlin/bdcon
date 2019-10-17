<?php
//Layout sistema.
//**************************************************************************************
$masterPageSelect = $_GET["masterPageSelect"];
if($masterPageSelect == "")
{
	$masterPageSelect = $_POST["masterPageSelect"];
}

if($masterPageSelect == "")
{
	$masterPageSelect = "LayoutSistemaComMenu.php";
}

//$page->title    = "Hello, world";
//$page->LayoutSistema = "LayoutSistemaComMenu.php";
$page->LayoutSistema = $masterPageSelect;
//**************************************************************************************
?>