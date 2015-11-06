<?php
  session_start();
  require_once("../model/DAO.class.php");
  require_once("../model/RSS.class.php");

  if (!isset($_SESSION['user']))
    header("Location:"."..");
  else {
    $dao = new DAO("../data/db/rss.db");
    $data['user']=$_SESSION['user'];
    if (isset($_POST['action']) && $_POST['action']=="follow" && isset($_POST['rss'])) {
      $dao->addAbonnement($_SESSION['user'],$_POST['rss'],$_POST['nom'],$_POST['categorie']);
      header("Location:"."..");
    }
    if (isset($_GET['action']) && $_GET['action']=="unfollow" && isset($_GET['rss'])) {
      $dao->deleteAbonnement($_SESSION['user'],$_GET['rss']);
      header("Location:"."..");
    }
    foreach ($dao->readUnfollowedRSS($_SESSION['user'],1,20) as $rss) {
      $r['id']=$rss->id();
      $r['titre']=$rss->titre();
      $r['url']=$rss->url();
      $data['flux'][]=$r;
    }

    include("../view/Follow.view.php");
  }
?>
