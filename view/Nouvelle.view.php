<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Nouvelle</title>
  </head>
  <body>
    <header>
      <h1>Feedix - Nouvelle</h1>
    </header>
    <section>
      <h2><?php echo($data["title"]); ?></h2>
      <i><?php echo($data['date']); ?></i>
      <img alt="Image" src="<?php echo($data['img']); ?>"/>
      <p><?php echo($data['desc']); ?></p>
    </section>
    <footer>
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
