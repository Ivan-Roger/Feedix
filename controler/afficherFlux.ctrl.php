<pre><?php
  session_start();
  require_once("../model/DAO.class.php");

  $dao = new DAO("../data/db/rss.db");
  if (isset($_SESSION['user]']))
    $data['user']=$_SESSION['user'];
  foreach($dao->readRSS(0,20) as $rss) {
    $info['id'] = $rss->id();
    $info['titre'] = $rss->titre();
    $info['url'] = $rss->url();
    $data['flux'][] = $info;
  }
echo ("</pre>");
  include("../view/Flux.view.php");
?>
