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

    $page = (isset($_GET['page'])?$_GET['page']:1);
    $nbPages = $dao->getNbRSS()/20;
    $data['page'][0] = ($page>1?$page-1:false); // prev
    $data['page'][1] = ($page<$nbPages?$page+1:false); // next
    $start = 1+($page-1)*20;

    foreach ($dao->readUnfollowedRSS($_SESSION['user'],$start,20) as $rss) {
      $r['id']=$rss->id();
      $r['titre']=$rss->titre();
      $r['url']=$rss->url();
      $data['flux'][]=$r;
    }

    if (isset($_GET['action']) && $_GET['action']=="select" && isset($_GET['rss'])) {
      $data['select']=$_GET['rss'];
    }

    include("../view/Follow.view.php");
  }
?>
