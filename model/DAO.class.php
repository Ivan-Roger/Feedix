<?php
  require_once("RSS.class.php");
  require_once("Nouvelle.class.php");

  class DAO {
    private $db; // L'objet de la base de donnée

    // Ouverture de la base de donnée
    function __construct($dbPath) {
      $dsn = 'sqlite:'.$dbPath; // Data source name
      try {
        $this->db = new PDO($dsn);
      } catch (PDOException $e) {
        exit("Erreur ouverture BD : ".$e->getMessage());
      }
    }

    //////////////////////////////////////////////////////////
    // Methodes CRUD sur RSS
    //////////////////////////////////////////////////////////

    // Lis $limit flux RSS a partir de $id
    function readRSS($first,$limit) {
      $sql = "Select * from RSS where id > ? limit ?";
      $req = $this->db->prepare($sql);
      $res = $req->execute(array($first,$limit));
      if ($res === FALSE) {
        die("getRSS error: no rss finded\n");
      }
      else {
        return $req->fetchAll(PDO::FETCH_CLASS, "RSS");
      }
    }

    // Crée un nouveau flux à partir d'une URL
    // Si le flux existe déjà on ne le crée pas
    function createRSS($url) {
      $rss = $this->readRSSByURL($url);
      if ($rss == NULL) {
        try {
          $sql = "INSERT INTO RSS (url) VALUES (?)";
          $req = $this->db->prepare($sql);
          $res = $req->execute(array($this->db->quote($url)));
          if ($res === FALSE || $req->rowCount()<=0) {
            echo ("PDO error : ".($this->db->errorInfo()[2])."\n");
            die("createRSS error: no rss inserted (".($res?'true':'false').")\n");
          }
          return $this->readRSSByURL($url);
        } catch (PDOException $e) {
          die("PDO Error :".$e->getMessage());
        }
      } else {
        // Retourne l'objet existant
        return $rss;
      }
    }

    // Acces à un objet RSS à partir de son URL
    function readRSSByURL($url) {
      $sql = "Select * from RSS where url = ?";
      $req = $this->db->prepare($sql);
      $res = $req->execute(array($url));
      if ($res === FALSE) {
        die("getRSSByURL error: no rss finded (".($res?'true':'false').")\n");
      }
      else {
        return $req->fetchAll(PDO::FETCH_CLASS, "RSS")[0];
      }
    }

    // Acces à un objet RSS à partir de son ID
    function readRSSByID($id) {
      $sql = "Select * from RSS where id = ?";
      $req = $this->db->prepare($sql);
      $res = $req->execute(array($id));
      if ($res === FALSE) {
        die("getRSSByURL error: no rss finded\n");
      }
      else {
        return $req->fetchAll(PDO::FETCH_CLASS, "RSS")[0];
      }
    }

    // Met à jour un flux
    function updateRSS(RSS $rss) {
      // Met à jour uniquement le titre et la date
      try {
        $titre = $this->db->quote($rss->titre());
        $sql = "UPDATE RSS SET titre=?, date='?' WHERE url='?'";
        $req = $this->db->prepare($sql);
        $res = $req->execute(array($titre,$rss->date(),$rss->url()));
        if ($res === FALSE || $req->rowCount()<=0) {
          die("updateRSS error: no rss updated\n");
        }
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    }

    //////////////////////////////////////////////////////////
    // Methodes CRUD sur Nouvelle
    //////////////////////////////////////////////////////////

    // Acces à une nouvelle à partir de son titre et l'ID du flux
    function readNouvelleByTitle($titre,$RSS_id) {
      $sql = "Select * from RSS where titre = ? and idRSS = ?";
      $req = $this->db->prepare($sql);
      $res = $req->execute(array($titre,$RSS_id));
      if ($req === FALSE) {
        die("getNouvelleByTitle error: no nouvelle inserted\n");
      }
      else {
        return $req->fetchAll(PDO::FETCH_CLASS, "Nouvelle")[0];
      }
    }

    // Acces à une nouvelle à partir de son ID et l'ID du flux
    function readNouvelleByID($id,$RSS_id) {
      $sql = "Select * from RSS where id = ? and idRSS = ?";
      $req = $this->db->prepare($sql);
      $res = $req->execute(array($id,$RSS_id));
      if ($req === FALSE) {
        die("getNouvelleByID error: no nouvelle inserted\n");
      }
      else {
        return $req->fetchAll(PDO::FETCH_CLASS, "Nouvelle")[0];
      }
    }

    // Crée une nouvelle dans la base à partir d'un objet nouvelle
    // et de l'id du flux auquelle elle appartient
    function createNouvelle(Nouvelle $n, $RSS_id) {
      $sql = "INSERT INTO Nouvelle (idRSS, date, titre, description, url, image) values ('?','?', '?', '?', '?', '?')";
      $req = $this->db->prepare($sql);
      $res = $req->execute(array($RSS_id,$n->date(),$n->titre(),$n->content(),$n->link(),$n->imageID()));
      if ($res === FALSE || $req->rowCount()<=0) {
        die("createNouvelle error: no nouvelle finded\n");
      }
    }

    // Met à jour le champ image de la nouvelle dans la base
    function updateImageNouvelle(Nouvelle $n) {
      try {
        $img = $this->db->quote($n->imageURL());
        $sql = "UPDATE RSS SET image=? WHERE id='?'";
        $req = $this->db->prepare($sql);
        $res = $req->execute(array($img,$n->id()));
        if ($res === FALSE || $req->rowCount()<=0) {
          die("updateImageNouvelle error: no nouvelle updated\n");
        }
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    }
  }
?>
