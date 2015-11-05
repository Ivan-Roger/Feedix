<?php if(!isset($data)) { header("Location".".."); } ?>
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
        <nav class="navbar">
          <div class="col-lg-4">
            <a class="btn btn-primary btn-lg active" href="..">Home</a>
          </div>
          <div class="col-lg-4 col-lg-offset-4 text-right">
            <?php if (isset($data['user'])) { ?>
              <a class="btn btn-danger btn-lg" href="afficherFlux.ctrl.php?action=signOut">Déconnexion (<?= $data['user'] ?>)</a>
            <?php } else { ?>
              <a class="btn btn-primary btn-lg" href="seConnecter.ctrl.php" >Connexion / Créer un compte</a>
            <?php } ?>
          </div>
        </nav>
    </header>
    <?php if (isset($data['user'])) { ?>
    <section class="col-lg-12">
      <h2>Abonnements</h2>
      <?php if (count($data["followedRSS"])>0) { foreach ($data["followedRSS"] as $flux) { ?>
        <article class="col-lg-6">
          <h3><?= $flux["titre"] ?></h3>
          <i class="col-lg-12"><a href="<?= $flux['url'] ?>"><?= $flux['url'] ?></a></i><br/>
          <div class="col-lg-5 col-lg-offset-2"><div class="text-right">
            <a class="btn btn-info" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>">Lire ...</a>
            <a class="btn btn-warning" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>&update=1">Mettre à jour</a>
            <a class="btn btn-danger" href="sAbonner.ctrl.php?action=unfollow&rss=<?= $flux['id'] ?>">Se désabonner</a>
          </div></div>
        </article>
      <?php } } else { ?>
        <p>Vous n'êtes abonné à aucun flux.</p>
      <?php } ?>
    </section>
    <?php } ?>
    <section class="col-lg-12">
      <?php if (isset($data['user'])) { ?>
      <h2>Flux par défaut</h2>
      <?php } ?>
      <?php foreach ($data["defaultRSS"] as $flux) {?>
        <article class="col-lg-6">
          <h3><?= $flux["titre"] ?></h3>
          <i class="col-lg-12"><a href="<?= $flux['url'] ?>"><?= $flux['url'] ?></a></i>
          <div class="col-lg-5 col-lg-offset-2"><div class="text-right">
            <a class="btn btn-info" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>">Lire ...</a>
            <a class="btn btn-warning" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>&update=1">Mettre à jour</a>
            <?php if (isset($data['user'])) { ?>
            <a class="btn btn-success" href="sAbonner.ctrl.php?action=follow&rss=<?= $flux['id'] ?>">S'abonner</a>
            <?php } ?>
          </b>
        </article>
      <?php } ?>
    </section>
    <?php if (isset($data['user'])) { ?>
      <section class="col-lg-12">
        <?php if(isset($data['info'])) echo("<p class='alert alert-success'>".$data['info']."</p>\n"); ?>
        <form class="col-lg-6" action="afficherFlux.ctrl.php" method="POST">
          <fieldset>
            <legend>Ajouter un flux</legend>
            <input type="hidden" name="action" value="addRSS"/>
            <input name="url" type="text" placeholder="URL"/>
            <input type="submit" value="Ajouter"/>
          </fieldset>
        </form>
        <fieldset class="col-lg-6">
          <legend>S'abonner</legend>
          <a class="btn btn-info" href="sAbonner.ctrl.php">Chercher un flux</a>
        </fieldset>
      </section>
    <?php } ?>
    <footer class="col-lg-12">
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
