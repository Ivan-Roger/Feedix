<?php
  session_start();
  require_once("../model/DAO.class.php");

  $dao = new DAO("../data/db/rss.db");
  if (isset($_GET['action']) && $_GET['action']=="signOut") // déconnexion
    unset($_SESSION['user']);
  if (isset($_POST['action']) && $_POST['action']=="addRSS" && isset($_POST['url'])) { // ajouter un flux et s'y abonner
    $dao->createRSS($_POST['url'],$_SESSION['user']);
    $rss=$dao->readRSSByURL($_POST['url']);
    $rss->update();
    $dao->updateRSS($rss);
    $dao->addAbonnement($_SESSION['user'],$rss->id(),$_POST['nom'],$_POST['categorie']);
    $data['info']="Flux ajouté !";
  }

  for ($i=1; $i<=4; $i++) { // Flux par défaut
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

    $page = (isset($_GET['page'])?$_GET['page']:1);
    $nbPages = $dao->getNbAbonnements($_SESSION['user'])/20;
    $data['page'][0] = ($page>1?$page-1:false); // prev
    $data['page'][1] = ($page<$nbPages?$page+1:false); // next
    $start = 1+($page-1)*20;

    $data['followedRSS'] = array();
    $data['user']=$_SESSION['user'];
    $data['linkFlags']="";
    if (isset($_GET['sort']) && $_GET['sort']=="date") {  // Abonnements, triées par date
      $data['linkFlags'].="&sort=date";
      foreach ($dao->readRSSAbonnementTrieDate($data['user'],$start,20) as $rss) {
        $list[]=$dao->readAbonnementByID($_SESSION['user'],$rss['idRSS']);
      }
    } else if (isset($_GET['sort']) && $_GET['sort']=="categorie" && isset($_GET['cat'])) { // Abonnements, de la categorie cat
      $data['linkFlags'].="&sort=cat&cat=".$_GET['cat'];
      $list = $dao->readAbonnementTrieCategorie($data['user'],$start,20,$_GET['cat']);
    } else if (isset($_GET['sort']) && $_GET['sort']=="categorie") { // Abonnements, triées par categorie
      $data['linkFlags'].="&sort=cat";
      $list = $dao->readAbonnementTrieCategorie($data['user'],$start,20);
    } else {    // Abonnements
      $list = $dao->readAbonnement($data['user'],$start,20);
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
