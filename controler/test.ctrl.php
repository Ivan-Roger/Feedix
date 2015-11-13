<?php
  require_once("../model/DAO.class.php");

  $dao = new DAO("../data/db/rss.db");
  echo("<meta charset='utf-8'/>");
  echo("<p style='width:600px;'>\n");
  $words = $dao->readWords($_GET['rss']);
  shuffle($words);
  foreach($words as $word) {
    echo("\t<span style='font-size:".(($word['count']*3)+10)."px'> ");
    echo($word['word']);
    echo("</span>");
  }
  echo("</p>\n");
?>
