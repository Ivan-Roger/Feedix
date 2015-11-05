<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Nouvelle</title>
    <link rel="stylesheet" href="../view/style.css"/>
  </head>
  <body>
    <header>
      <h1>Feedix - Nouvelle</h1>
    </header>
    <section>
      <a href="..">Home</a><br/>
      <article class="NouvelleDetailed">
        <div class="pic">
          <img alt="Image" src="../data/img/<?= ($data['nouvelle']['img']!=null?$data['nouvelle']['img']:"default.jpeg") ?>"/>
        </div>
        <h2><?= $data['nouvelle']['title']?></h2>
        <i><?= $data['nouvelle']['date'] ?></i><br>
        <p><?= $data['nouvelle']['desc'] ?></p>
      </article>
    </section>
    <footer>
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
