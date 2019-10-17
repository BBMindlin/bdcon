<?php //Arquivos para a bilioteca de funções personalizadas.?>
<script src="../js/include-funcoes.js" type="text/javascript"></script>


<?php //Arquivos para a biblioteca JQuery.?>
<?php //**************************************************************************************?>
<!--script type="text/javascript" src="../jquery/datepicker/js/jquery-1.8.2.min.js"></script-->
<script type="text/javascript" src="../jquery/jquery-1.8.3.js"></script>
<!--script type="text/javascript" src="../jquery/jquery-2.1.3.min.js"></script--><!--Obs: dando problema com slimbox2.-->
<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"> </script--><!--Carregador do servidor (Google). -->
<!--script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"> </script--><!--Carregador do servidor (Microsoft). -->
<?php //**************************************************************************************?>


<?php //Arquivos para User Interface JQuery.?>
<?php //**************************************************************************************?>
<?php 
//http://jqueryui.com/download
?>
<!--link type="text/css" href="../jquery/datepicker/css/redmond/jquery-ui-1.8.24.custom.css" rel="stylesheet" /--> <!--Theme: redmond.-->
<!--link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"-->
<!--link rel="stylesheet" href="../jquery/ui/1.10.4/themes/smoothness/jquery-ui-1.10.4.custom.css"--> <!--Theme: smoothness.-->
<link rel="stylesheet" href="../jquery/ui/1.11.2/themes/smoothness/jquery-ui.css" /> <!--Theme: smoothness.-->

<!--script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script-->
<script type="text/javascript" src="../jquery/ui/1.11.2/themes/smoothness/jquery-ui.js"></script>

<?php //**************************************************************************************?>


<?php //Arquivos para o componente DatePicker.?>
<?php //**************************************************************************************?>
<!--link type="text/css" href="../jquery/datepicker/css/redmond/jquery-ui-1.8.24.custom.css" rel="stylesheet" /-->
<script type="text/javascript" src="../jquery/datepicker/js/jquery-ui-1.8.24.custom.min.js"></script>
<?php //**************************************************************************************?>


<?php //Arquivos para o componente SlimBox 2.?>
<?php //**************************************************************************************?>
<link rel="stylesheet" href="../jquery/slimbox2/css/slimbox2.css" type="text/css" media="screen" />
<script type="text/javascript" src="../jquery/slimbox2/js/slimbox2-pt.js"></script>
<?php //**************************************************************************************?>


<?php //Arquivos para o componente do Carrossel Simples (utilizado para o scroll vertical também).?>
<?php //Site: http://jquery.malsup.com/cycle2/demo/carousel.php?>
<?php //**************************************************************************************?>
<link rel="stylesheet" href="../jquery/carrossel1/EstilosCarrossel1.css" type="text/css" media="screen" />
<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script-->
<!--script type="text/javascript" defer="defer" src="../jquery/carrossel1/jquery.cycle2.js"></script-->
<script type="text/javascript" defer="defer" src="../jquery/carrossel1/jquery.cycle2.min.js"></script>
<script type="text/javascript" defer="defer" src="../jquery/carrossel1/jquery.cycle2.carousel.js"></script>
<?php //**************************************************************************************?>


<?php //Arquivos para o componente JQuery Feature Carousel.?>
<?php //**************************************************************************************?>
<?php 
//Ref:
//https://www.bkosborne.com/jquery-feature-carousel/options
//Ouras possibilidades:
//- http://kenwheeler.github.io/slick/
//- http://wowslider.com/jquery-picture-slider-catalyst-digital-stack-demo.html
//- http://www.webdevelopers.eu/shop/5/demo
?>
<script type="text/javascript" src="../jquery/jQuery-Feature-Carousel/js/jquery.featureCarousel.min.js" charset="utf-8"></script>
<link href="../jquery/jQuery-Feature-Carousel/css/feature-carousel.css" rel="stylesheet" type="text/css" charset="utf-8" />
<?php //**************************************************************************************?>


<?php //Arquivos para o componente BX Slider.?>
<?php //**************************************************************************************?>
<?php 
//ref:
//http://bxslider.com/options
?>
<link href="../jquery/bxslider/jquery.bxslider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery/bxslider/jquery.bxslider.min.js"></script>
<?php //**************************************************************************************?>


<?php //Arquivos para o componente Bootstrap 2 Carousel Fade.?>
<?php //Obs: Pode estar dando conflito com algum outro script. Pegar como referência o projeto sp engenharia.?>
<?php //**************************************************************************************?>
<!--link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap.min.css'-->
<link rel='stylesheet prefetch' href='../jquery/bootstrap-carossel/bootstrap.min.css' />
<link type="text/css" href="../jquery/bootstrap-carossel/bootstrap-carossel.css" rel="stylesheet" />
<!--script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js'></script-->
<script type="text/javascript" defer="defer" src="../jquery/bootstrap-carossel/bootstrap.min.js"></script>
<?php //**************************************************************************************?>


<?php //Arquivos para o componente BG Stretcher (slide de fundo, porém dá problema com rodapé fixo no fundo da página - 04).?>
<?php //**************************************************************************************?>
<link type="text/css" href="../jquery/bgstretcher/bgstretcher.css" rel="stylesheet" />
<script type="text/javascript" defer="defer" src="../jquery/bgstretcher/bgstretcher.js"></script>
<script type="text/javascript">
    //Aplicação.
    /*
    $(document).ready(function(){
    //  Initialize Backgound Stretcher	   
        $('body').bgStretcher({
        images: ['img/layout-fundo1.jpg', 'img/layout-fundo2.jpg', 'img/layout-fundo3.jpg', 'img/layout-fundo4.jpg'],
        //images: ['img/fundo01.jpg'],
        imageWidth: 1800, 
        imageHeight: 1193, 
        slideDirection: 'N',
        nextSlideDelay: 6000,
        slideShowSpeed: 3000,
        transitionEffect: 'fade',
        sequenceMode: 'normal',
        buttonPrev: '#prev',
        buttonNext: '#next',
        pagination: '#nav',
        anchoring: 'left top',
        anchoringImg: 'left top'
        });
    });
    */
</script>
<?php //**************************************************************************************?>


<?php //Arquivos para o componente BackStretch (não tem slide, porém não dá problema com rodapé fixo no fundo da página - 04).?>
<?php //**************************************************************************************?>
<script type="text/javascript" defer="defer" src="../jquery/backstretch/jquery.backstretch.min.js"></script>
<script type="text/javascript">
    //Aplicação.
    //$.backstretch("img/fundo01.jpg");
</script>
<?php //**************************************************************************************?>



<?php //Arquivos para o componente bgswitcher (slide show background div).?>
<?php //**************************************************************************************?>
<?php // 
    //Site: 
    //http://www.jqueryscript.net/slideshow/Lightweight-jQuery-Background-Slideshow-Plugin-BgSwitcher.html
?>
<script type="text/javascript" src="../jquery/bgswitcher/jquery.bgswitcher.js"></script>
<script type="text/javascript">

</script>
<?php //**************************************************************************************?>


<?php //Calender (full calendar 2.6.1).?>
<?php //**************************************************************************************?>
<?php // 
    //Site: 
    //http://fullcalendar.io/

    //Outros sites para pequisar:
    //http://zabuto.com/dev/calendar/examples/
    //http://kylestetz.github.io/CLNDR/
    //http://www.web-delicious.com/jquery-plugins-demo/wdCalendar/sample.php
    //http://codecanyon.net/item/jalendar-2-calendar-pack-event-range-and-more/full_screen_preview/12662442?ref=jqueryrain&ref=jqueryrain&clickthrough_id=658752097&redirect_back=true
    //https://www.daypilot.org/calendar-tutorial/
?>

<link href='../jquery/fullcalendar-2.6.1/fullcalendar.css' rel='stylesheet' />
<link href='../jquery/fullcalendar-2.6.1/fullcalendar.print.css' rel='stylesheet' media='print' />

<script type="text/javascript" src='../jquery/fullcalendar-2.6.1/lib/moment.min.js'></script>
<!--script type="text/javascript" src='../lib/jquery.min.js'></script-->
<script type="text/javascript" src='../jquery/fullcalendar-2.6.1/fullcalendar.min.js'></script>
<script type="text/javascript" src='../jquery/fullcalendar-2.6.1/lang/pt-br.js'></script>

<style>
    /*

    body 
    {
        margin: 40px 10px;
        padding: 0;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
    */
</style>
<?php //**************************************************************************************?>


<?php //Arquivos para o componente CLEditor.?>
<?php //**************************************************************************************?>
<script type="text/javascript" src="../jquery/cleditor/jquery.cleditor.min.js"></script>
<script type="text/javascript" src="../jquery/cleditor/jquery.cleditor.xhtml.min.js"></script>
<script type="text/javascript" src="../jquery/cleditor/jquery.cleditor.advancedtable.min.js"></script>

<script type="text/javascript">
	//Controles básicos.
	var CLEditorBasicoControles = "bold italic underline strikethrough | subscript superscript | removeformat | undo redo | link unlink | cut copy paste pastetext | source";
	var CLEditorBasicoFontes = "Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond,Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana";

	//Controles avançados.
	var CLEditorAvancadoControles = "bold italic underline strikethrough | subscript superscript | font size " +
									"style | color highlight removeformat | bullets numbering | outdent " +
									"indent | alignleft center alignright justify | undo redo | " +
									"rule image | link unlink | cut copy paste pastetext | table | print source";
	var CLEditorAvancadoFontes = "Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond,Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana";
</script>

<link rel="stylesheet" type="text/css" href="../jquery/cleditor/jquery.cleditor.css" />
<?php //**************************************************************************************?>


<?php //JQuery Validate.?>
<?php //**************************************************************************************?>
<?php 
//Site:
//http://jqueryvalidation.org/

//Outras opções para pesquisar:
//http://contactmetrics.com/blog/validate-contact-form-jquery
//http://formvalidator.net/
//http://formvalidation.io/
?>
<script type="text/javascript" src="../jquery/jqueryvalidate/additional-methods.min.js"></script>
<script type="text/javascript" src="../jquery/jqueryvalidate/jquery.validate.min.js"></script>
<?php //**************************************************************************************?>


<?php //Arquivos para o componente ALS.?>
<?php //**************************************************************************************?>
<?php 
/*
ref: http://als.musings.it/
*/
?>
<link type="text/css" href="../jquery/als/als.css" rel="stylesheet" />
<script type="text/javascript" src="../jquery/als/jquery.als-1.7.min.js"></script>
<?php //**************************************************************************************?>


<?php //Canvas JS.?>
<?php //**************************************************************************************?>
<?php 
/*
ref:
http://canvasjs.com/
http://canvasjs.com/docs/charts/basics-of-creating-html5-chart/

Outras ref:
http://omnipotent.net/
http://www.chartjs.org/
*/
?>
<script type="text/javascript" src="../jquery/canvasjs/canvasjs.min.js"></script>
<?php //**************************************************************************************?>


<?php //Arquivos para o componente JQuery Countdown.?>
<?php //**************************************************************************************?>
<?php 
	//ref:
	//http://hilios.github.io/jQuery.countdown/documentation.html#formatter
?>
<script type="text/javascript" src="../jquery/countdown/jquery.countdown.min.js"></script>
<?php //**************************************************************************************?>
