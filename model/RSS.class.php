<?php

  class RSS {
    private $url;
    private $titre;
    private $date;
    private $news;

    function __construct($url) {
      $this->url = $url;
      $this->update();
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

    function update() {
      // Cree un objet pour accueillir le contenu du RSS : un document XML
      $doc = new DOMDocument;

      //Telecharge le fichier XML dans $rss
      $doc->load($this->url);

      // Recupère la liste (DOMNodeList) de tous les elements de l'arbre 'title'
      $nodeList = $doc->getElementsByTagName('title');

      // Met à jour le titre dans l'objet
      $this->titre = $nodeList->item(0)->textContent;
    }
  }

?>
