<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Nouvelles</title>
  </head>
  <body>
    <header>
      <h1>Feedix - Nouvelles</h1>
      <?php include("nav.php") ?>
    </header>
    <section>
      <?php foreach ($data["news"] as $nouvelle) {?>
        <article>
          <h2><?php echo($nouvelle["title"]); ?></h2>
          <i><?php echo($nouvelle['date']); ?></i>
          <img alt="Image" src="<?php echo($nouvelle['img']); ?>"/>
          <p><?php echo($nouvelle['desc']); ?></p>
        </article>
      <?php}?>
    </section>
    <footer>
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
