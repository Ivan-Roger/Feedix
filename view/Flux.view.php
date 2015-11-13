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
    body {
      margin-top: 10px;
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
            <a class="btn btn-primary btn-lg <?php if (!isset($_GET['sort'])) { ?>active" disabled="disabled<?php } ?>" href=".."><span class="glyphicon glyphicon-home"></span> Home</a>
          </div>
          <div class="col-lg-4 col-lg-offset-4 text-right">
            <?php if (isset($data['user'])) { ?>
              <a class="btn btn-danger btn-lg" href="afficherFlux.ctrl.php?action=signOut"><span class="glyphicon glyphicon-log-out"></span> Déconnexion (<?= $data['user'] ?>)</a>
            <?php } else { ?>
              <a class="btn btn-primary btn-lg" href="seConnecter.ctrl.php" ><span class="glyphicon glyphicon-log-in"></span> Connexion / Créer un compte</a>
            <?php } ?>
          </div>
        </nav>
    </header>
    <?php if (isset($data['user'])) { ?>
    <section class="col-lg-12">
      <?php if(isset($data['info'])) echo("<p class='alert alert-success'>".$data['info']."</p>\n"); ?>
      <h2 class="col-lg-6">Abonnements</h2>
      <div class="col-lg-5 col-lg-offset-1">
        <div class="navbar navbar-right">
          <br/>
          <div class="btn-group">
            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trier <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="afficherFlux.ctrl.php">Annuler le tri</a></li>
              <li><a href="afficherFlux.ctrl.php?sort=date">Trier par Date</a></li>
              <li><a href="afficherFlux.ctrl.php?sort=categorie">Trier par Categorie</a></li>
            </ul>
          </div>
        </div>
      </div>
      <hr/>
      <?php if (count($data["followedRSS"])>0) { $i=0; foreach ($data["followedRSS"] as $flux) { ?>
        <?php if ($i==0) {?><div class="row"><?php } ?>
        <article class="col-lg-6">
          <h3><?= $flux['nom'] ?> <small><?= $flux["titre"] ?></small></h3>
          <i class="col-lg-6"><a href="<?= $flux['url'] ?>"><?= $flux['url'] ?></a></i>
          <em class="col-lg-6"><?= $flux['date'] ?></em><br/>
          <div class="col-lg-2">
            <a href="afficherFlux.ctrl.php?sort=categorie&cat=<?= $flux['categorie'] ?>"><span class="glyphicon glyphicon-tag"></span> <?= $flux['categorie'] ?></a>
          </div>
          <div class="col-lg-6"><div class="navbar-right">
            <a class="btn btn-info" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>">Lire ...</a>
            <a class="btn btn-warning" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>&update=1">Mettre à jour</a>
            <a class="btn btn-danger" href="sAbonner.ctrl.php?action=unfollow&rss=<?= $flux['id'] ?>">Se désabonner</a>
          </div></div>
        </article>
        <?php if ($i==1) {?></div><?php } else $i++; ?>
      <?php } } else { ?>
        <p>Vous n'êtes abonné à aucun flux.</p>
      <?php } ?>
      <nav class="col-lg-12">
        <ul class="pager">
          <li class="previous <?php if (!$data['page'][0]) { ?> disabled"><a href="#<?php } else { ?>"><a href="afficherFlux.ctrl.php?page=<?= $data['page'][0] ?><?= $data['linkFlags'] ?><?php } ?>"><span aria-hidden="true">&larr;</span> Précédent</a></li>
          <li class="next <?php if (!$data['page'][1]) { ?> disabled"><a href="#<?php } else { ?>"><a href="afficherFlux.ctrl.php?page=<?= $data['page'][1] ?><?= $data['linkFlags'] ?><?php } ?>">Suivant <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
      </nav>
    </section>
    <?php } ?>
    <?php if (!isset($data['user'])) { ?>
      <blockquote class="col-lg-8 col-lg-offset-2">Bienvenue sur Feedix. Vous pouvez consulter les differents flux par défaut ci-dessous, ou encore vous Connecter/Créer un compte. Avec ce compte vous pourrez vous abonner aux differents flux du site afin de rester au courant des dernières nouvelles. Pour plus d'informations lisez <a href="../README.php"> la documentation</a>.</blockquote>
    <?php } ?>
    <section class="col-lg-12">
      <?php if (isset($data['user'])) { ?>
      <h2 class="col-lg-12">Flux par défaut</h2>
      <hr/>
      <?php } ?>
      <?php foreach ($data["defaultRSS"] as $flux) {?>
        <article class="col-lg-6">
          <h3><?= $flux["titre"] ?></h3>
          <i class="col-lg-6"><a href="<?= $flux['url'] ?>"><?= $flux['url'] ?></a></i>
          <em class="col-lg-6"><?= $flux['date'] ?></em>
          <div class="col-lg-6 col-lg-offset-2"><div class="navbar-right">
            <a class="btn btn-info" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>">Lire ...</a>
            <a class="btn btn-warning" href="afficherNouvelles.ctrl.php?rss=<?= $flux['id'] ?>&update=1">Mettre à jour</a>
            <?php if (isset($data['user'])) { ?>
              <?php if ($flux['follow']) { ?><a class="btn btn-success" href="sAbonner.ctrl.php?action=select&rss=<?= $flux['id'] ?>">S'abonner</a><?php } else { ?>
              <a class="btn btn-danger" href="sAbonner.ctrl.php?action=unfollow&rss=<?= $flux['id'] ?>">Se désabonner</a><?php } ?>
            <?php } ?>
          </div></div>
        </article>
      <?php } ?>
    </section>
    <?php if (isset($data['user'])) { ?>
        <form class="form-horizontal col-lg-6" action="afficherFlux.ctrl.php" method="POST">
          <fieldset>
            <legend>Ajouter un flux</legend>
            <input type="hidden" name="action" value="addRSS"/>
            <div class="form-group">
              <label class="col-lg-2 control-label" for="addForm_URL">URL</label>
              <div class="col-lg-6"><input required class="form-control" type="text" name="url" id="addForm_URL"/></div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label" for="addForm_Nom">Nom</label>
              <div class="col-lg-6"><input required class="form-control" type="text" name="nom" id="addForm_Nom"/></div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label" for="addForm_Categorie">Categorie</label>
              <div class="col-lg-6"><input required class="form-control" type="text" name="categorie" id="addForm_Categorie"/></div>
            </div>
            <input class="col-lg-2 col-lg-offset-2 btn btn-info" type="submit" value="Ajouter le flux"/>
            <small class="col-lg-10 col-lg-offset-1">En ajoutant le flux vous vous y abonnez automatiquement.</small>
          </fieldset>
        </form>
        <fieldset class="col-lg-6">
          <legend>S'abonner</legend>
          <blockquote class="col-lg-12">Pour garder un flux en avant et pouvoir toujours rester au courant des dernières nouvelles abonnez vous. En cliquant sur le bouton ci-dessous vous pouvez acceder a la liste de tous les flux disponibles sur le site. Si le flux que vous cherchez n'est pas présent ajoutez le à gauche.</blockquote>
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
