<?php
  $DEBUG = FALSE;

  require_once("RSS.class.php");
  require_once("Nouvelle.class.php");

  function debug($db,$sql,$params) {
    global $DEBUG;
    if ($DEBUG) {
      echo "Requête : ".$sql."\n";
      echo "Paramétres : ";
      foreach ($params as $p) {
        echo $p."\t";
      }
      echo "\n";
      if ($db->errorInfo()[1]!=null) {
        echo "DB error : ".$db->errorInfo()[2]."\n";
      } else {
        echo "Success !\n";
      }
    }
  }

  class DAO {
    private $db; // L'objet de la base de donnée

    // Ouverture de la base de donnée
    function __construct($dbPath) {
      $dsn = 'sqlite:'.$dbPath; // Data source name
      try {
        $this->db = new PDO($dsn);
      } catch (PDOExcetion $e) {
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
          $res = $req->execute(array($url));
          if ($res === FALSE) {
            debug($this->db,$sql);
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
        return $req->fetchAll(PDO::FETCH_CLASS, "RSS", array($url))[0];
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
        $sql = "UPDATE RSS SET titre=?, date=? WHERE url=?";
        $req = $this->db->prepare($sql);
        $params=array(
          $this->db->quote($rss->titre()),
          $this->db->quote($rss->date()),
          $this->db->quote($rss->url())
        );
        $res = $req->execute($params);
        debug($this->db,$sql,$params);
        if ($res === FALSE) {
          echo("updateRSS error: no rss updated\n");
        }
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    }

    //////////////////////////////////////////////////////////
    // Methodes CRUD sur Nouvelle
    //////////////////////////////////////////////////////////

    // Lis $limit flux Nouvelles a partir de $id
    function readNouvelles($first,$RSS_id,$limit) {
      $sql = "SELECT * FROM Nouvelle WHERE id > ? AND idRSS = ? ORDER BY idRSS, id LIMIT ?";
      $req = $this->db->prepare($sql);
      $params = array($first,$RSS_id,$limit);
      $res = $req->execute($params);
      debug($this->db,$sql,$params);
      if ($res === FALSE) {
        die("readNouvelle error: no Nouvelle finded\n");
      }
      else {
        return $req->fetchAll(PDO::FETCH_CLASS, "Nouvelle",array($RSS_id));
      }
    }

    // Acces à une nouvelle à partir de son titre et l'ID du flux
    function readNouvelleByTitle($titre,$RSS_id) {
      $sql = "Select * from RSS where titre = ? and id = ?";
      $req = $this->db->prepare($sql);
      $res = $req->execute(array($titre,$RSS_id));
      if ($req === FALSE) {
        die("getNouvelleByTitle error: no nouvelle inserted\n");
      }
      else {
        $rows = $req->fetchAll(PDO::FETCH_CLASS, "Nouvelle",array($RSS_id));
        if (count($rows)>0) {
          return $rows[0];
        }
      }
    }

    // Acces à une nouvelle à partir de son ID et l'ID du flux
    function readNouvelleByID($id,$RSS_id) {
      $sql = "SELECT * FROM Nouvelle WHERE id = ? AND idRSS = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $id,
        $RSS_id
      );
      $res = $req->execute($params);
      debug($this->db,$sql,$params);
      if ($req === FALSE) {
        die("readNouvelleByID error: no nouvelle found\n");
      }
      else {
        return $req->fetchAll(PDO::FETCH_CLASS, "Nouvelle",array($RSS_id))[0];
      }
    }

    // Crée une nouvelle dans la base à partir d'un objet nouvelle
    // et de l'id du flux auquelle elle appartient
    function createNouvelle(Nouvelle $n) {
      $sql = "INSERT INTO Nouvelle (id, idRSS, `date`, titre, description, imageID) values (?,?,?, ?, ?, ?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $n->id(),
        $n->idRSS(),
        $n->date(),
        $n->titre(),
        $n->description(),
        $n->imageURL()
      );
      $res = $req->execute($params);
      debug($this->db,$sql,$params);
      if ($res === FALSE) {
        die("createNouvelle error: no nouvelle finded\n");
      }
    }

    // Met à jour la nouvelle dans la base
    function updateNouvelle(Nouvelle $n) {
      try {
        $sql = "SELECT COUNT(*) AS nb FROM Nouvelle WHERE id=? AND idRSS = ?";
        $req = $this->db->prepare($sql);
        $params = array(
          $n->id(),
          $n->idRSS()
        );
        debug($this->db,$sql,$params);
        $res = $req->execute($params);
        if ($res === FALSE) {
          die("updateNouvelle error : requête comptage impossible\n");
        }
        if ($req->fetch()['nb']>0) { // La ligne existe, on la met a jour.
          $sql = "UPDATE Nouvelle SET `date` = ? , titre = ? , description = ? , url = ? , imageID=? WHERE id=? AND idRSS = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $n->date(),
            $n->titre(),
            $n->description(),
            $n->URL(),
            $n->imageURL(),
            $n->id(),
            $n->idRSS()
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            die("updateImageNouvelle error: update impossible\n");
          }
        } else { // La ligne n'existe pas, on la crée
          $this->createNouvelle($n);
        }
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    }
  }


  //echo("Error DB : ".$this->db->errorInfo()[2]);
?>
