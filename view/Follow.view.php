<?php if (!isset($data)) header("Location".".."); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Abonnement</title>
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
      <h1>Feedix - Abonnement</h1>
      <nav class="navbar">
        <div class="col-lg-6">
          <a class="btn btn-primary btn-lg" href=".."><span class="glyphicon glyphicon-home"></span> Home</a>
        </div>
        <div class="col-lg-2 col-lg-offset-4 text-right">
          <?php if (isset($data['user'])) { ?>
            <a class="btn btn-danger btn-lg" href="afficherFlux.ctrl.php?action=signOut"><span class="glyphicon glyphicon-log-out"></span> Déconnexion (<?= $data['user'] ?>)</a>
          <?php } else { ?>
            <a class="btn btn-primary btn-lg" href="seConnecter.ctrl.php" ><span class="glyphicon glyphicon-log-in"></span> Connexion / Créer un compte</a>
          <?php } ?>
        </div>
      </nav>
    </header>
    <div class="container">
      <section class="col-lg-12">
        <?php $i=1; foreach ($data['flux'] as $rss) { if($i==1) echo("<div class='row'>\n");?>
        <article class="col-lg-4">
          <h3><?= $rss["titre"] ?></h3>
          <i class="col-lg-12"><a href="<?= $rss['url'] ?>"><?= $rss['url'] ?></a></i>
          <input type="hidden" id="rss_<?= $rss['id'] ?>_titre" value="<?= $rss['titre'] ?>"/>
          <input type="hidden" id="rss_<?= $rss['id'] ?>_url" value="<?= $rss['url'] ?>"/>
          <div class="col-lg-5 col-lg-offset-2"><div class="text-right">
            <button id="rss_<?= $rss['id'] ?>_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#subscribeModal" onClick="setFormValues(<?= $rss['id'] ?>);">
              S'abonner
            </button>
          </div></div>
        </article>
        <?php if ($i==3) { echo("</div>"); $i=1; } else $i++; } ?>
      </section>
      <nav class="col-lg-12">
        <ul class="pager">
          <li class="previous <?php if (!$data['page'][0]) { ?> disabled"><a href="#<?php } else { ?>"><a href="sAbonner.ctrl.php?page=<?= $data['page'][0] ?><?php } ?>"><span aria-hidden="true">&larr;</span> Précédent</a></li>
          <li class="next <?php if (!$data['page'][1]) { ?> disabled"><a href="#<?php } else { ?>"><a href="sAbonner.ctrl.php?page=<?= $data['page'][1] ?><?php } ?>">Suivant <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
      </nav>
    </div>
    <div class="modal fade" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="subscribeModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="subscribeModalLabel">S'abonner</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal col-lg-12" action="sAbonner.ctrl.php" method="POST">
              <input type="hidden" name="action" value="follow"/>
              <input type="hidden" name="rss" id="subscribeModalForm_RSS"/><br/>
              <h2><span id="subscribeModal_Titre"></span><br/><small id="subscribeModal_URL"></small></h2>
              <div class="form-group">
                <label class="col-lg-2 control-label" for="subscribeModalForm_Nom">Nom</label>
                <div class="col-lg-6"><input required class="form-control" type="text" name="nom" id="subscribeModalForm_Nom"/></div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label" for="subscribeModalForm_Categorie">Categorie</label>
                <div class="col-lg-6"><input required class="form-control" type="text" name="categorie" id="subscribeModalForm_Categorie"/></div>
              </div>
              <input class="col-lg-offset-3 btn btn-success" type="submit" value="S'abonner"/>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <footer class="col-lg-12">
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <script>
      function setFormValues(id) {
        console.log("Update du modal : rss "+id);
        $('#subscribeModalForm_RSS').attr('value',id);
        var titre = $("#rss_"+id+"_titre").attr('value');
        $('#subscribeModal_Titre').html(titre);
        console.log("titre = "+titre);
        var url = $("#rss_"+id+"_url").attr('value');
        $('#subscribeModal_URL').html(url);
        console.log("url = "+url);
      }

      <?php if (isset($data['select'])) { ?>
      $("#rss_<?= $data['select'] ?>_btn").click();
      <?php } ?>
    </script>
  </body>
</html>
