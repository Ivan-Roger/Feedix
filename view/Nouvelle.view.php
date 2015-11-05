<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Nouvelle</title>
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
        background-color: #DDD;
        border: 1px solid #AAA;
        border-bottom: none;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        background: linear-gradient(rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,1), rgba(200,200,200,0));
      }
      article div {
        text-align: center;
      }
      article div img {
        max-height: 300px;
      }
  </style>
  <body>
    <header class="page-header">
      <h1>Feedix - Nouvelle</h1>
      <nav class="navbar">
        <div class="col-lg-6">
          <a class="btn btn-primary btn-lg" href="..">Home</a>
          <a class="btn btn-primary btn-lg" href="afficherNouvelles.ctrl.php?rss=<?= $data['idRSS'] ?>">Retour</a>
        </div>
        <div class="col-lg-2 col-lg-offset-4 text-right">
          <?php if (isset($data['user'])) { ?>
            <a class="btn btn-danger btn-lg" href="afficherFlux.ctrl.php?action=signOut">Déconnexion (<?= $data['user'] ?>)</a>
          <?php } else { ?>
            <a class="btn btn-primary btn-lg" href="seConnecter.ctrl.php" >Connexion / Créer un compte</a>
          <?php } ?>
        </div>
      </nav>
    </header>
    <section>
      <article class="col-lg-8 col-lg-offset-2">
        <div class="col-lg-12">
          <img alt="Image" class="text-center" src="../data/img/<?= ($data['nouvelle']['img']!=null?$data['nouvelle']['img']:"default.jpeg") ?>"/>
        </div>
        <h2><?= $data['nouvelle']['title']?></h2>
        <i class="col-lg-4"><?= $data['nouvelle']['date'] ?></i>
        <a href="<?= $data['nouvelle']['link'] ?>" class="btn btn-default btn-lg col-lg-2 col-lg-offset-6" target="_blank">Lire l'article ...</a><br/>
        <p><?= $data['nouvelle']['desc'] ?></p>
      </article>
    </section>
    <footer class="col-lg-12">
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
