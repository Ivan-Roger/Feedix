<pre><?php
  require_once("../model/DAO.class.php");
  require_once("../model/RSS.class.php");
  require_once("../model/Nouvelle.class.php");

  if (isset($_GET['rss']) && $_GET['rss']!=null) {
    $dao = new DAO("../data/db/rss.db");
    $rss = $dao->readRSSByID($_GET['rss']);
    if (isset($_GET['update']) && $_GET['update']==1) {
      $rss->update();
      $dao->updateRSS($rss);
      $news = $rss->news();
      foreach ($news as $nouv) {
        $dao->createNouvelle($nouv);
      }
    } else {
      $dao->readNouvelles(0,$_GET['rss'],20);
    }
    $data['news'] = array();
    $data[0] = 1;
    if ($news!=null) {
      foreach ($news as $nouv) {
        //$dao->createNouvelle($nouv,$_GET['rss']);
        var_dump($nouv);
        $n['title'] = $nouv->titre();
        $n['date'] = $nouv->date();
        $n['img'] = $nouv->imageURL();
        $n['desc'] = $nouv->description();
        $data['news'][]=$n;
      }
    } else {
      echo("--- Debug: Pas de nouvelles\n");
    }
    echo("</pre>");
    include("../view/Nouvelles.view.php");
  } else {
    header("Location:"."..");
  }
?>
