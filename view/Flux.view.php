<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Flux</title>
  </head>
  <body>
    <header>
      <h1>Feedix - Flux</h1>
      <?php include("nav.php") ?>
    </header>
    <section>
      <?php foreach ($data["flux"] as $flux) {?>
        <article>
          <h2><?php echo($flux["title"]); ?></h2>
          <i><a href="<?php echo($flux['url']); ?>"><?php echo($flux['url']); ?></a></i>
        </article>
      <?php}?>
    </section>
    <footer>
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
