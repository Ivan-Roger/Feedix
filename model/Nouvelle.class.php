<?php

  class Nouvelle {
    private $id;
    private $idRSS;
    private $titre;
    private $date;
    private $image;
    private $url;
    private $description;

    function __construct($id=null,$idRSS, DOMElement $item=null) {
      $this->image=null;
      if ($item!=null) {
        $this->id=$id;
        $this->update($item);
      }
    }

    function id() {
      return $this->id;
    }

    function idRSS() {
      return $this->idRSS;
    }

    function titre() {
      return $this->titre;
    }

    function date() {
      return $this->date;
    }

    function imageURL() {
      return $this->image;
    }

    function URL() {
      return $this->url;
    }

    function description() {
      return $this->description;
    }

    function update(DOMElement $item) {
      $nodeList = $item->getElementsByTagName('title');
      $this->titre = $nodeList->item(0)->textContent;

      $nodeList = $item->getElementsByTagName('pubDate');
      $this->date = $nodeList->item(0)->textContent;

      $nodeList = $item->getElementsByTagName('description');
      $this->content = $nodeList->item(0)->textContent;

      $nodeList = $item->getElementsByTagName('link');
      $this->link = $nodeList->item(0)->textContent;
    }

    function downloadImage(DOMElement $item, $imageID) {
      $nodeList = $item->getElementsByTagName('enclosure');
      if ($nodeList->length>0) {
        $url = $nodeList->item(0)->attributes->getNamedItem('url')->value;
        $pathParts = pathinfo(parse_url($url, PHP_URL_PATH));
        $ext = ((isset($pathParts['extension']) && $pathParts['extension']!=null)?$pathParts['extension']:null);
        if ($ext!=null) {
          $filepath = "../data/img/".$imageID.".".$ext;
          //echo "DEBUG : Saving $url in $filepath<br/>";
          $img = file_get_contents($url);
          file_put_contents($filepath,$img);
          $this->imageID = $imageID.".".$ext;
        }
      }
    }
  }

?>
