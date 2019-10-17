<?php
//Funções especiais.
//**************************************************************************************
//require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/ContadorUniversal.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/ContadorUniversal.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Funcoes.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Funcoes.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/DbUpdate.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/DbFuncoes.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/DbUpdate.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/DbInsert.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/DbExcluir.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Arquivo.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Arquivo.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Imagem.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Imagem.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/XMLFuncoes.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/XMLFuncoes.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/JsonFuncoes.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/VideoFuncoes.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Crypto.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/CookiesFuncoes.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/LoginAutenticacao.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Formularios.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Email.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Pedidos.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Orcamentos.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Carrinho.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/Exportacao.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/PDFFuncoes.php";

require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/CEP.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/IBGE.php";
//**************************************************************************************


//Objetos.
//**************************************************************************************
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/ObjetoCadastroDetalhes.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/ObjetoProdutosDetalhes.php";
//**************************************************************************************


//Funções de terceiros.
//**************************************************************************************
//Imagem Magician.
//require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/imageMagicianV1/php_image_magician.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/imageMagicianV1/php_image_magician.php";

//PHP Mailer (5.2.10).
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/phpMailer5.2.10/class.phpmailer.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/phpMailer5.2.10/class.pop3.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/phpMailer5.2.10/class.smtp.php";

//Defuse php-encrypt.
//https://github.com/defuse/php-encryption
//https://github.com/defuse/php-encryption/releases
//https://stackoverflow.com/questions/16600708/how-do-you-encrypt-and-decrypt-a-php-string
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/php-encryption-2.1.0/autoload.php";

//PDF2Text.
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/webcheatsheet/PDF2Text.php";

//TCPDF.
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/include/barcodes/datamatrix.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/include/barcodes/pdf417.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/include/barcodes/qrcode.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/tcpdf.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/tcpdf_barcodes_2d.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/tcpdf_barcodes_1d.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/include/tcpdf_colors.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/include/tcpdf_filters.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/include/tcpdf_fonts.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/include/tcpdf_font_data.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/include/tcpdf_images.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/tcpdf_import.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/tcpdf_parser.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/tecnickcom/tcpdf/include/tcpdf_static.php";

//PDF Parser.
//Ref: https://gist.github.com/smalot/6183152
//require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser/autoload.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Parser.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Document.php";
//require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser/src/Smalot/PdfParser/Object.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/PDFObject.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Header.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Font.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Page.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Pages.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Encoding.php";

require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementArray.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementBoolean.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementString.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementDate.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementHexa.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementMissing.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementName.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementNull.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementNumeric.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementStruct.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Element/ElementXRef.php";

require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Font/FontCIDFontType0.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Font/FontCIDFontType2.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Font/FontTrueType.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Font/FontType0.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Font/FontType1.php";

require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Encoding/StandardEncoding.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Encoding/ISOLatin1Encoding.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Encoding/ISOLatin9Encoding.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Encoding/MacRomanEncoding.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/Encoding/WinAnsiEncoding.php";

require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/XObject/Form.php";
require_once $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/pdfparser-0.11.0/src/Smalot/PdfParser/XObject/Image.php";
//**************************************************************************************
?>