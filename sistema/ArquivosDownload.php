<?php
require_once "IncludeConfig.php"; //Deve vir antes do db.
//require_once "IncludeConexao.php";
//require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
//require_once "IncludeLayout.php";

ignore_user_abort(true);
set_time_limit(0); // disable the time limit for this script

//$path = "/absolute_path_to_your_files/"; // change the path to fit your websites document structure
$path = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/";
$dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\].]|[\.]{2,})", '', $_GET['nomeArquivo']); // simple file name validation
$dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
$fullPath = $path.$dl_file;

if ($fd = fopen ($fullPath, "r")) {
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "pdf":
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
        break;
        // add more headers for other content types here
        default;
		//Original:
        //header("Content-type: application/octet-stream");
        //header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
        header("Content-type: application/octet-stream");
		header("Content-Transfer-Encoding: Binary");
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
        break;
    }
    header("Content-length: $fsize");
    header("Cache-control: private"); //use this to open files directly
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
fclose ($fd);
exit;
?>