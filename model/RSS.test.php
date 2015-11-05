<pre><?php
/*
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

  echo("<hr/>");

  // Test de la classe DAO
  require_once('DAO.class.php');
  $dao = new DAO("../data/db/rss.db");

  // Test si l'URL existe dans la BD
  $url = 'http://www.lemonde.fr/m-actu/rss_full.xml';

  $rss = $dao->readRSSByURL($url);
  if ($rss == NULL) {
    echo $url." n'est pas connu\n";
    echo "On l'ajoute ... \n";
    $rss = $dao->createRSS($url);
  }

  // Mise à jour du flux
  $rss->update();
  */

  require_once('DAO.class.php');
  $dao = new DAO("../data/db/rss.db");

  $res = $dao->readNouvelleByID(1,1);
  var_dump($res);

?></pre>
