<?php
  session_start();
  require_once("../model/DAO.class.php");

  $dao = new DAO("../data/db/rss.db");

  if (isset($_SESSION['user']))
    header("Location:"."..");
  else if (isset($_POST['action']) && $_POST['action']=="connect" && isset($_POST['user']) && isset($_POST['pass'])) {
    if ($dao->validatePassword($_POST['user'],$_POST['pass'])) {
      $_SESSION['user']=$_POST['user'];


      header("Location:"."..");
    } else if ($dao->validateLogin($_POST['user'])) {
      $data['error'] = "Mot de passe invalide";
      include("../view/Connect.view.php");
    } else {
      $data['error'] = "Nom d'utilisateur invalide";
      include("../view/Connect.view.php");
    }
  } else if (isset($_POST['action']) && $_POST['action']=="signIn" && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['pass2'])) {
    if ($_POST['pass']!=$_POST['pass2']) {
      $data['error'] = "Les deux mot de passe sont différents";
      include("../view/Connect.view.php");
    } else {
      $dao->createUser($_POST['user'],$_POST['pass']);


      header("Location:"."..");
    }
  } else {
    include("../view/Connect.view.php");
  }
?>
