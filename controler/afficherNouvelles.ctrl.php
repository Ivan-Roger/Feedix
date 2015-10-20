<?php
  require_once("../model/Nouvelle.class.php");

  if (isset($_GET['rss']) && isset($_GET['titre'])) {
    $dao = new DAO("../data/db/rss.db");
    $nouv = $dao->readNouvellefromTitre($_GET['titre'],$_GET['rss']);

    $data['title'] = $nouv->titre();
    $data['date'] = $nouv->date();
    $data['img'] = $nouv->imageURL();
    $data['desc'] = $nouv->description();

    include("../view/Nouvelle.view.php");
  } else {
    header("Location:"."..");
  }
?>
