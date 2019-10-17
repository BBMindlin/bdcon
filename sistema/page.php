<?php
$page->title    = "Hello, world";
$page->template = "template.php";
?>
<?php ob_start(); /* head   */ ?>
  <meta name="description" content="description here">
<?php $page->head = ob_get_clean(); 

?>
<?php ob_start(); /* content*/ ?>
  <h1>The Page Title</h1>
  <p>The article goes here</p>
<?php $page->content = ob_get_clean(); 

?>
<?php ob_start(); /* foot   */ ?>
  <script type="text/javascript">  /* page specific script */ </script>
<?php $page->foot = ob_get_clean(); 

?>
<?php include_once $page->template ?>