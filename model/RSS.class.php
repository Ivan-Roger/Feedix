<?php
  require_once('Nouvelle.class.php');
  require_once('DAO.class.php');

  class RSS {
    private $url;
    private $titre;
    private $date;
    private $news;
    private $id;

    function __construct($url="") {
      if ($url!="") {
          $this->url = $url;
          $this->update();
      }
      //$this->update();
    }

    function url() {
      return $this->url;
    }

    function titre() {
      return $this->titre;
    }

    function date() {
      return $this->date;
    }

    function news() {
      return $this->news;
    }

    function id() {
      return $this->id;
    }

    function update() {
      // Cree un objet pour accueillir le contenu du RSS : un document XML
      $doc = new DOMDocument;

      //Telecharge le fichier XML dans $rss
      $doc->load($this->url);

      // Recupère la liste (DOMNodeList) de tous les elements de l'arbre 'title'
      $nodeList = $doc->getElementsByTagName('title');

      // Met à jour le titre dans l'objet
      $this->titre = $nodeList->item(0)->textContent;

      $this->news=NULL;
      $dao = new DAO("../data/db/rss.db");
      $idNouv=$dao->getIdMaxNouvelle($this->id)+1;
      $nodeList = $doc->getElementsByTagName('item');
      for ($i=0; $i<$nodeList->length; $i++) {
        $n = new Nouvelle($this->id,$idNouv,$nodeList->item($i));
        $n->downloadImage($nodeList->item($i),$this->id."_".$idNouv++);
        $this->news[] = $n;
      }
    }
  }

?>
