<?php
  require_once("model/Parsedown.class.php");
  $text = file_get_contents("README.md");
  $md = new Parsedown();
  $content = $md->text($text);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Feedix - README</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="data/css/bootstrap.min.css" />
  </head>
  <body>
    <div class="col-lg-10 col-lg-offset-1">
      <?= $content ?>
      <a class="btn btn-primary btn-lg" href="index.php"><span>&larr;</span> Retour</a>
    </div>
  </body>
</html>
