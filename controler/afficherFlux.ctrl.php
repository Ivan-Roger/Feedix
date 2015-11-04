<pre><?php
  require_once("../model/DAO.class.php");

  $dao = new DAO("../data/db/rss.db");
  foreach($dao->readRSS(0,20) as $rss) {
    //$dao->updateRSS($rss);
    $info['id'] = $rss->id();
    $info['titre'] = $rss->titre();
    $info['url'] = $rss->url();
    $data['flux'][] = $info;
  }
echo ("</pre>");
  include("../view/Flux.view.php");
?>
