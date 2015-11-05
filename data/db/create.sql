CREATE TABLE RSS (
  id integer PRIMARY KEY AUTOINCREMENT,
  titre varchar(255),
  url varchar(255),
  date timestamp
);

CREATE TABLE Nouvelle (
  id integer,
  idRSS integer,
  date timestamp,
  titre varchar(255),
  description varchar(255),
  url varchar(255),
  imageID varchar(80),
  FOREIGN KEY (idRSS) REFERENCES RSS(id),
  PRIMARY KEY (id,idRSS)
);

CREATE TABLE Utilisateur(
  login varchar(10) PRIMARY KEY,
  pass varchar(8)
);

CREATE TABLE Abonnement (
  userLogin varchar(10),
  idRSS int,
  nom varchar(40),
  categorie varchar(40),
  FOREIGN KEY (userLogin) REFERENCES Utilisateur(login),
  FOREIGN KEY (idRSS) REFERENCES RSS(id),
  PRIMARY KEY (userLogin,idRSS)
);
