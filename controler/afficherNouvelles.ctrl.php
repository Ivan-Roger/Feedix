<?php
  session_start();
  require_once("../model/DAO.class.php");
  require_once("../model/RSS.class.php");
  require_once("../model/Nouvelle.class.php");
  require_once("../model/utils.class.php");

  if (isset($_SESSION['user']))
    $data['user']=$_SESSION['user'];
  if (isset($_GET['rss']) && $_GET['rss']!=null) {
    $dao = new DAO("../data/db/rss.db");

    $page = (isset($_GET['page'])?$_GET['page']:1);
    $nbPages = $dao->getNbNouvelles($_GET['rss'])/20;
    $data['page'][0] = ($page>1?$page-1:false); // prev
    $data['page'][1] = ($page<$nbPages?$page+1:false); // next
    $start = 1+($page-1)*20;

    $rss = $dao->readRSSByID($_GET['rss']);
    $news=null;
    if (isset($_GET['update']) && $_GET['update']==1) {
      $rss->update();
      $dao->updateRSS($rss);
      $dao->deleteWords($_GET['rss']);
      foreach ($rss->news() as $nouv) {
        $dao->updateNouvelle($nouv);
        $dao->updateWords($_GET['rss'],getWords($nouv->description()));
      }
    }
    $news=$dao->readNouvelles($start,$_GET['rss'],20);
    $data['news'] = array();
    $data[0] = 1;
    $data['flux']['titre'] = $dao->readRSSByID($_GET['rss'])->titre();
    $data['idRSS'] = $_GET['rss'];
    $data['words'] = $dao->readWords($_GET['rss']);
    shuffle($data['words']);
    if ($news!=null) {
      foreach ($news as $nouv) {
        $n['id'] = $nouv->id();
        $n['title'] = $nouv->titre();
        $n['date'] = $nouv->date();
        $n['img'] = $nouv->imageURL();
        $n['desc'] = $nouv->description();
        $data['news'][]=$n;
      }
    }
    include("../view/Nouvelles.view.php");
  } else {
    header("Location:"."..");
  }
?>
