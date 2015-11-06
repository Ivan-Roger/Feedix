<?php
  session_start();
  require_once("../model/DAO.class.php");

  $dao = new DAO("../data/db/rss.db");
  if (isset($_GET['action']) && $_GET['action']=="signOut")
    unset($_SESSION['user']);
  if (isset($_POST['action']) && $_POST['action']=="addRSS" && isset($_POST['url'])) {
    $dao->createRSS($_POST['url'],$_SESSION['user']);
    $rss=$dao->readRSSByURL($_POST['url']);
    $rss->update();
    $dao->updateRSS($rss);
    $dao->addAbonnement($_SESSION['user'],$rss->id(),$_POST['nom'],$_POST['categorie']);
    $data['info']="Flux ajouté !";
  }

  for ($i=1; $i<=4; $i++) {
    $rss=$dao->readRSSByID($i);
    $info['id'] = $rss->id();
    $info['titre'] = $rss->titre();
    $info['url'] = $rss->url();
    $info['date'] = $rss->date();
    if (isset($_SESSION['user']))
      $info['follow']=$dao->readAbonnementByID($_SESSION['user'],$i)==null;
    $data['defaultRSS'][] = $info;
  }

  if (isset($_SESSION['user'])) {
    $data['followedRSS'] = array();
    $data['user']=$_SESSION['user'];
    if (isset($_GET['sort']) && $_GET['sort']=="date") {  // Abonnements, triées par date
      foreach ($dao->readRSSAbonnementTrieDate($data['user']) as $rss) {
        $list[]=$dao->readAbonnementByID($_SESSION['user'],$rss['idRSS']);
      }
    } else if (isset($_GET['sort']) && $_GET['sort']=="categorie" && isset($_GET['cat'])) { // Abonnements, de la categorie cat
      $list = $dao->readAbonnementTrieCategorie($data['user'],1,20,$_GET['cat']);
    } else if (isset($_GET['sort']) && $_GET['sort']=="categorie") { // Abonnements, triées par categorie
      $list = $dao->readAbonnementTrieCategorie($data['user']);
    } else {    // Abonnements
      $list = $dao->readAbonnement($data['user']);
    }
    foreach ($list as $abo) {
      $rss=$dao->readRSSByID($abo['idRSS']);
      $info['id'] = $rss->id();
      $info['titre'] = $rss->titre();
      $info['nom'] = $abo['nom'];
      $info['url'] = $rss->url();
      $info['date'] = $rss->date();
      $info['categorie'] = $abo['categorie'];
      $data['followedRSS'][] = $info;
    }
  }
  include("../view/Flux.view.php");
?>
