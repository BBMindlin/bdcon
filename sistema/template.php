<?php Header("Content-Type: text/html; charset=UTF-8"); ?>
<html>
  <head>
    <title><?php echo $page->title; ?></title>
    <link rel="stylesheet" type="text/css" href="/path/to/stylesheet.css">
    <?php echo $page->head; ?>
  </head>
  <body>
    <nav>
      <ul>
        <li><a href="/">Nav item 1</a></li>
        ...
        <li><a href="/">Nav item n</a></li>
      </ul>
    </nav>
    <div>
      <?php echo $page->content; ?>
    </div>
    <footer>
      footer message here
    </footer>
  </body>
  <?php echo $page->foot; ?>
</html>