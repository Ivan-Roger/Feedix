<?php
  // Test de la classe RSS
  require_once('RSS.class.php');

  // Une instance de RSS
  $rss = new RSS('http://www.lemonde.fr/m-actu/rss_full.xml');

  // Charge le flux depuis le réseau
  $rss->update();

  // Affiche le titre et la description de toutes les nouvelles
  foreach($rss->news() as $key => $nouvelle) {
    echo '<div><h2>'.$nouvelle->titre().'</h2>';
    echo '<i>'.$nouvelle->date()."</i><br/>";
    echo '<img src="../data/img/'.$nouvelle->imageURL().'" style="width: 250px;">';
    echo '<p>'.$nouvelle->description()."</p></div><br/>";
  }
?>
