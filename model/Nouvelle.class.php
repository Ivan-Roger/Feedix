<?php

  class Nouvelle {
    private $titre;
    private $date;
    private $imageID;
    private $link;
    private $content;

    function __construct(DOMElement $item) {
      $this->update($item);
      $this->imageID=NULL;
    }

    function titre() {
      return $this->titre;
    }

    function date() {
      return $this->date;
    }

    function imageURL() {
      return $this->imageID;
    }

    function description() {
      return $this->content;
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
      if ($nodeList->length) {
        $url = $nodeList->item(0)->attributes->getNamedItem('url')->value;
        $filepath = "../data/img/".$imageID.".".pathinfo($url)['extension'];
        //echo "DEBUG : Saving $url in $filepath<br/>";
        $img = file_get_contents($url);
        file_put_contents($filepath,$img);
        $this->imageID = $imageID.".".pathinfo($url)['extension'];;
      }
    }
  }

?>
