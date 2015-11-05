<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Nouvelles</title>
    <link rel="stylesheet" href="../view/style.css"/>
  </head>
  <body>
    <header>
      <h1>Feedix - Nouvelles</h1>
    </header>
    <section>
    <a href="..">Home</a><br/>
      <?php if (count($data["news"])>0) { foreach ($data["news"] as $nouvelle) {?>
        <article>
          <div class="pic">
            <img alt="Image" src="../data/img/<?= ($nouvelle['img']!=null?$nouvelle['img']:"default.jpeg") ?>"/>
          </div>
          <h2><?= $nouvelle['title']?></h2>
          <i><?= $nouvelle['date'] ?></i><br>
          <p><?= $nouvelle['desc'] ?></p>
        </article>
      <?php }} else { ?>
        <p class="info">Il n'y a rien ici ... Essayez de mettre à jour !</p>
      <?php } ?>
    </section>
    <footer>
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
