<pre><?php
  require_once("../model/DAO.class.php");
  require_once("../model/RSS.class.php");
  require_once("../model/Nouvelle.class.php");

  if (isset($_GET['rss']) && $_GET['rss']!=null) {
    $dao = new DAO("../data/db/rss.db");
    $rss = $dao->readRSSByID($_GET['rss']);
    $news=null;
    if (isset($_GET['update']) && $_GET['update']==1) {
      $rss->update();
      $dao->updateRSS($rss);
      $news = $rss->news();
      foreach ($news as $nouv) {
        $dao->updateNouvelle($nouv);
      }
    } else {
      $news=$dao->readNouvelles(0,$_GET['rss'],20);
    }
    $data['news'] = array();
    $data[0] = 1;
    if ($news!=null) {
      foreach ($news as $nouv) {
        $n['id'] = $nouv->id();
        $n['idRSS'] = $nouv->idRSS();
        $n['title'] = $nouv->titre();
        $n['date'] = $nouv->date();
        $n['img'] = $nouv->imageURL();
        $n['desc'] = $nouv->description();
        $data['news'][]=$n;
      }
    } else {
      //echo("--- Debug: Pas de nouvelles\n");
    }
    echo("</pre>");
    include("../view/Nouvelles.view.php");
  } else {
    header("Location:"."..");
  }
?>
