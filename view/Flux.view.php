<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Flux</title>
    <link rel="stylesheet" href="../view/style.css"/>
  </head>
  <body>
    <header>
      <nav>
        <h1>Feedix - Flux</h1>
        <input type="submit" name="action" value="Se connecter" />
      </nav>
    </header>
    <section>
      <?php foreach ($data["flux"] as $flux) {?>
        <article>
          <h2>#<?= $flux['id'] ?> : <?= $flux["titre"] ?></h2>
          <i><a href="<?= $flux['url'] ?>"><?= $flux['url'] ?></a></i>
          <b><a href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>">Lire ...</a> / <a href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>&update=1">Mettre à jour.</a></b>
        </article>
      <?php } ?>
    </section>
    <footer>
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
