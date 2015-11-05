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
            margin:0
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
        font-size: 70px;
      }
      footer p {
        text-align: center;
      }
   </style>
  <body>

    <header class="page-header">
      <h1>Feedix - Flux</h1>
        <nav class="navbar-right">
          <?php if (isset($data['user'])) { ?>
            <?= $data['user'] ?> : <a class="btn btn-danger btn-lg" href="afficherFlux.ctrl.php?action=signOut">Déconnexion</a>
          <?php } else { ?>
            <a class="btn btn-primary btn-lg" href="seConnecter.ctrl.php" >Connexion / Créer un compte</a>
          <?php } ?>
        </nav>-->

    </header>
    <?php if (isset($data['user'])) { ?>
    <section>
      <h2>Abonnements</h2>
      <?php if (count($data["followedRSS"])>0) { foreach ($data["followedRSS"] as $flux) { ?>
        <article class="col-lg-6">
          <h2 >#<?= $flux['id'] ?> : <?= $flux["titre"] ?></h2>
          <i><a href="<?= $flux['url'] ?>"><?= $flux['url'] ?></a></i>
          <b class="btn-group"><a class="btn btn-default" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>">Lire ...</a> <a class="btn btn-default" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>&update=1">Mettre à jour</a></b>
        </article>
      <?php } } else { ?>
        <p>Vous n'êtes abonnés a aucun flux</p>
      <?php } ?>
    </section>
    <?php } ?>
    <section>
      <?php if (isset($data['user'])) { ?>
      <h2>Flux par défaut</h2>
      <?php } ?>
      <?php foreach ($data["defaultRSS"] as $flux) {?>
        <article class="col-lg-6">
          <h2><?= $flux["titre"] ?></h2>
          <i><a href="<?= $flux['url'] ?>"><?= $flux['url'] ?></a></i>
          <b><a href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>">Lire ...</a> / <a href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>&update=1">Mettre à jour.</a></b>
        </article>
      <?php } ?>
    </section>
    <?php if (isset($data['user'])) { ?>
      <section class="col-lg-12">
        <form class="col-lg-6" action="afficherFlux.ctrl.php" method="POST">
          <fieldset>
            <legend>Ajouter un flux</legend>
            <input type="hidden" name="action" value="addRSS"/>
            <input name="url" type="text" placeholder="URL"/>
            <input type="submit" value="Ajouter"/>
          </fieldset>
        </form>
        <form class="col-lg-6" action="afficherFlux.ctrl.php" method="POST">
          <fieldset>
            <legend>S'abonner</legend>
            <input type="hidden" name="action" value="addRSS"/>
            <input name="url" type="text" placeholder="URL"/>
            <input type="submit" value="Ajouter"/>
          </fieldset>
        </form>
      </section>
    <?php } ?>
    <footer class="col-lg-12">
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
