<?php 

echo "SERVER_ADDR (ip - servidor): " . $_SERVER['SERVER_ADDR'] . "<br/>";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "<br/>";
echo "dirname: " . dirname(__FILE__) . "<br/>";


echo phpinfo();


if (function_exists("array_combine"))
{
	echo "Function exists";
}
else
{
	echo "Function does not exist - better write our own";
}

?>