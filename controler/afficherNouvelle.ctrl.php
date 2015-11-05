<?php
  require_once("../model/Nouvelle.class.php");
  require_once("../model/DAO.class.php");

  if (isset($_GET['rss']) && isset($_GET['id'])) {
    $dao = new DAO("../data/db/rss.db");
    $nouv = $dao->readNouvelleByID($_GET['id'],$_GET['rss']);

    $data['nouvelle']['title'] = $nouv->titre();
    $data['nouvelle']['date'] = $nouv->date();
    $data['nouvelle']['img'] = $nouv->imageURL();
    $data['nouvelle']['desc'] = $nouv->description();

    include("../view/Nouvelle.view.php");
  } else {
    header("Location:"."..");
  }
?>
