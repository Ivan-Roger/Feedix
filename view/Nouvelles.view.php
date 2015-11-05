<?php if(!isset($data)) header("Location".".."); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Nouvelles</title>
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
      article {
        overflow: hidden;
        max-height: 350px;
        background-color: #DDD;
        border: 1px solid #AAA;
        border-bottom: none;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        background: linear-gradient(rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,0));
      }
      article p img {
        display: none;
      }
  </style>
  </head>
  <body>
    <header class="page-header">
      <h1>Feedix - Nouvelles</h1>
      <nav class="navbar">
        <div class="col-lg-4">
          <a class="btn btn-primary btn-lg" href="..">Home</a>
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
    <div class="container">
      <section class="col-lg-12">
        <?php $i=1; if (count($data["news"])>0) { foreach ($data["news"] as $nouvelle) {?>
          <?php if ($i==1) { ?>
          <div class="row">
          <?php } ?>
            <article class="col-lg-3">
            <div>
              <a href="afficherNouvelle.ctrl.php?id=<?= $nouvelle['id']?>&rss=<?= $nouvelle['idRSS'] ?>">
                <img alt="Image" class="col-lg-12" src="../data/img/<?= ($nouvelle['img']!=null?$nouvelle['img']:"default.jpeg") ?>"/>
              </a>
            </div>
            <a href="afficherNouvelle.ctrl.php?id=<?= $nouvelle['id']?>&rss=<?= $nouvelle['idRSS'] ?>">
              <h3 class="panel-title"><?= $nouvelle['title']?></h3>
            </a>
            <i><?= $nouvelle['date'] ?></i><br>
            <p><?= $nouvelle['desc'] ?></p>
            </article>
            <div class="col-lg-1"></div>
          <?php
            if ($i==3) {
              $i=1;
              echo("</div><br/><br/>\n");
            } else
              $i++;
            }
          } else {
        ?>
          <p class="alert alert-info">Il n'y a rien ici ... Essayez de mettre à jour !</p>
        <?php } ?>
      </section>
    </div>
    <footer class="col-lg-12">
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
