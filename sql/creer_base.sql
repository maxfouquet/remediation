-- Création de la base de données
CREATE DATABASE IF NOT EXISTS remediation;

use remediation;

DROP TABLE IF EXISTS utilisateur;
CREATE TABLE utilisateur (idUtilisateur int AUTO_INCREMENT NOT NULL,
nom VARCHAR(32),
prenom VARCHAR(32),
adresse VARCHAR(50),
identifiant VARCHAR(32),
motdepasse VARCHAR(50),
idRole INT,
PRIMARY KEY (idUtilisateur)) ENGINE=InnoDB;

DROP TABLE IF EXISTS role;
CREATE TABLE role (idRole int AUTO_INCREMENT NOT NULL,
libelle VARCHAR(32),
PRIMARY KEY (idRole)) ENGINE=InnoDB;

DROP TABLE IF EXISTS vulnerabilite;
CREATE TABLE vulnerabilite (idVuln int AUTO_INCREMENT NOT NULL,
description VARCHAR(255),
severite INT(2),
etat BOOLEAN,
PRIMARY KEY (idVuln)) ENGINE=InnoDB;

DROP TABLE IF EXISTS application;
CREATE TABLE application (idApp int AUTO_INCREMENT NOT NULL,
nomApp VARCHAR(32),
descriptionApp VARCHAR(255),
PRIMARY KEY (idApp)) ENGINE=InnoDB;

DROP TABLE IF EXISTS contenir;
CREATE TABLE contenir (idVuln int AUTO_INCREMENT NOT NULL,
idApp INT NOT NULL,
PRIMARY KEY (idVuln,
 idApp)) ENGINE=InnoDB;

ALTER TABLE utilisateur ADD CONSTRAINT FK_utilisateur_idRole FOREIGN KEY (idRole) REFERENCES role (idRole) ON DELETE CASCADE;
ALTER TABLE contenir ADD CONSTRAINT FK_contenir_idVuln FOREIGN KEY (idVuln) REFERENCES vulnerabilite (idVuln) ON DELETE CASCADE;
ALTER TABLE contenir ADD CONSTRAINT FK_contenir_idApp FOREIGN KEY (idApp) REFERENCES application (idApp) ON DELETE CASCADE;
