<?php

  class Nouvelle {
    private $titre;
    private $date;
    private $image;
    private $link;
    private $enclosures;
    private $content;

    function titre() {
      return $this->titre;
    }

    function date() {
      return $this->date;
    }

    function imageURL() {
      return $this->image;
    }

    function content() {
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

      /*
      $nodeList = $item->getElementsByTagName('enclosure');
      for ($i=0; i<$nodeList->length; $i++) {
        $this->enclosures[$i] = $nodeList->item($i)->textContent;
      }
      */
    }
  }

?>
