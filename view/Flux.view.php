<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Flux</title>
    <link href="../data/css/bootstrap.css" rel="stylesheet">
  </head>
  <style type="text/css">
     [class*="col"] { margin-bottom: 20px; }
     body { margin-top: 10px;
            margin:0;
            padding:0;
          }

      header {
        background-color: #00C0F0;
      }
      header h1 {
        color: white;
        text-align: center;
        font-weight:bold;
        text-shadow:
      #000000 1px 1px,
      #000000 -1px 1px,
      #000000 -1px -1px,
      #000000 1px -1px;
        font-size: 50px;
      }

   </style>
  <body>
    <header class="page-header">
      <h1 class="">Feedix - Flux</h1>
        <nav class="navbar-right">
          <a class="btn btn-primary" href="#" > se connecter </a>
        </nav>


    </header>
    <section>
      <?php foreach ($data["flux"] as $flux) {?>
        <article class="col-lg-6">
          <h2 >#<?= $flux['id'] ?> : <?= $flux["titre"] ?></h2>
          <i><a href="<?= $flux['url'] ?>"><?= $flux['url'] ?></a></i>
          <b><a href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>">Lire ...</a> / <a href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>&update=1">Mettre à jour.</a></b>
        </article>
      <?php } ?>
    </section>
    <footer class="col-lg-12">
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
