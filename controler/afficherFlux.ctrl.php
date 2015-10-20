<?php
  require_once("../model/DAO.class.php");

  $dao = new DAO("../data/db/rss.db");

  foreach($dao->readRSS(0,20) as $rss) {
    $info['title'] = $rss->titre();
    $info['url'] = $rss->url();
    $data['flux'][] = $info;
  }

  include("../view/Flux.view.php");
?>
