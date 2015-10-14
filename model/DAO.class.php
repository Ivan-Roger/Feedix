<?php
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

        // Crée un nouveau flux à partir d'une URL
        // Si le flux existe déjà on ne le crée pas
        function createRSS($url) {
          $rss = $this->readRSSfromURL($url);
          if ($rss == NULL) {
            try {
              $q = "INSERT INTO RSS (url) VALUES ('$url')";
              $r = $this->db->exec($q);
              if ($r == 0) {
                die("createRSS error: no rss inserted\n");
              }
              return $this->readRSSfromURL($url);
            } catch (PDOException $e) {
              die("PDO Error :".$e->getMessage());
            }
          } else {
            // Retourne l'objet existant
            return $rss;
          }
        }

        // Acces à un objet RSS à partir de son URL
        function readRSSfromURL($url) {
          $sql = "Select * from RSS where url = ?";
          $req = $this->db->prepare($sql);
          $res = $req->execute(array($url));
          if ($res === FALSE) {
            die("selectRSS error: no rss finded\n");
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
            if ($res === FALSE) {
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
        function readNouvellefromTitre($titre,$RSS_id) {
          $sql = "Select * from RSS where titre = ? and idRSS = ?";
          $req = $this->db->prepare($sql);
          $res = $req->execute(array($titre,$RSS_id));
          if ($req === FALSE) {
            die("selectNouvelle error: no nouvelle inserted\n");
          }
          else {
            return $req->fetchAll(PDO::FETCH_CLASS, "Nouvelle")[0];
          }
        }

        // Crée une nouvelle dans la base à partir d'un objet nouvelle
        // et de l'id du flux auquelle elle appartient
        function createNouvelle(Nouvelle $n, $RSS_id) {
          $sql = "INSERT INTO Nouvelle (idRSS, date, titre, description, url, image) values ('?','?', '?', '?', '?', '?')"
          $req = $this->db->prepare($sql);
          $res = $req->execute(array($RSS_id,$n->date(),$n->titre(),$n->content(),$n->link(),$n->imageID()));
          if ($res === FALSE) {
            die("createNouvelle error: no nouvelle finded\n");
        }

//// Mettre la requête en préparé. \/

        // Met à jour le champ image de la nouvelle dans la base
        function updateImageNouvelle(Nouvelle $n) {
          $img = $this->db->quote($n->imageURL());
          $q = "UPDATE RSS SET image=$img WHERE id='".$n->id()."'";
          try {
            $r = $this->db->exec($q);
            if ($r == 0) {
              die("updateNouvelle error: no nouvelle updated\n");
            }
          } catch (PDOException $e) {
            die("PDO Error :".$e->getMessage());
          }
        }

        ?>
