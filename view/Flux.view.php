<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Flux</title>
  </head>
  <body>
    <header>
      <h1>Feedix - Flux</h1>
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
