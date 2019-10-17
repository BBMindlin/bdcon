<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";

echo "DOCUMENT_ROOT=" . $_SERVER['DOCUMENT_ROOT'] . "<br>";

echo "raizCaminhoFisico=" . $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/ContadorUniversal.php";

//Teste de função dentro de Funcoes.php
echo "valor=" . "2,23" . "<br />";
//echo "Funcoes=>MascaraValorGravar=" . Funcoes->MascaraValorGravar("2,23") . "<br />";
echo "MascaraValorGravar=" . MascaraValorGravar("2,23") . "<br />";
echo "Funcoes::MascaraValorGravar=" . Funcoes::MascaraValorGravar("2,23") . "<br />";

?>
