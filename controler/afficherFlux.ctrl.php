<?php
  session_start();
  require_once("../model/DAO.class.php");

  $dao = new DAO("../data/db/rss.db");
  if (isset($_GET['action']) && $_GET['action']=="signOut")
    unset($_SESSION['user']);
  if (isset($_POST['action']) && $_POST['action']=="addRSS" && isset($_POST['url'])) {
    $dao->createRSS($_POST['url']);
  }

  for ($i=1; $i<=4; $i++) {
    $rss=$dao->readRSSByID($i);
    $info['id'] = $rss->id();
    $info['titre'] = $rss->titre();
    $info['url'] = $rss->url();
    $data['defaultRSS'][] = $info;
  }

  if (isset($_SESSION['user'])) {
    $data['followedRSS'] = array();
    $data['user']=$_SESSION['user'];
    foreach ($dao->readAbonnement($data['user']) as $idAbo) {
      $rss=$dao->readRSSByID($idAbo['idRSS']);
      $info['id'] = $rss->id();
      $info['titre'] = $rss->titre();
      $info['url'] = $rss->url();
      $data['followedRSS'][] = $info;
    }
  }
  include("../view/Flux.view.php");
?>
