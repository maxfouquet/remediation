INSERT INTO role (idRole, libelle) VALUES (1, "utilisateur");
INSERT INTO role (idRole, libelle) VALUES (2, "responsable");
INSERT INTO role (idRole, libelle) VALUES (3, "administrateur");

INSERT INTO utilisateur (nom, prenom, adresse, identifiant, motdepasse, idRole) VALUES ("Labossière", "Normand", "normand.Labossiere@monentreprise.com", "n.labossiere", "fb5b69ef463c61b3848dd69f17905467687fb872", 1);
INSERT INTO utilisateur (nom, prenom, adresse, identifiant, motdepasse, idRole) VALUES ("Voisine", "Élise", "elise.voisine@monentreprise.com", "e.voisine", "dde6b7c7aec8515d3fe77822e6f2c1ad2a41d5cc", 2);
INSERT INTO utilisateur (nom, prenom, adresse, identifiant, motdepasse, idRole) VALUES ("Déziel", "Dominic", "dominic.deziel@monentreprise.com", "d.deziel", "3e3d58df2b5ec3e0e34c47640499c993f18ad0d7", 3);

INSERT INTO vulnerabilite (idVuln, description, severite, etat) VALUES (1, "Local File Inclusion (LFI)", 1, 0);
INSERT INTO vulnerabilite (idVuln, description, severite, etat) VALUES (2, "Cross Site Scripting (XSS)", 2, 0);
INSERT INTO vulnerabilite (idVuln, description, severite, etat) VALUES (3, "SQL Injection (SQLi)", 3, 0);

INSERT INTO application (idApp, nomApp, descriptionApp) VALUES (1, "Pégase", "Gestion de la paie");
INSERT INTO application (idApp, nomApp, descriptionApp) VALUES (2, "Zeus", "Gestion des absences");
INSERT INTO application (idApp, nomApp, descriptionApp) VALUES (3, "Médusa", "Annuaire des collaborateurs");

INSERT INTO contenir (idVuln, idApp) VALUES (3, 1);
INSERT INTO contenir (idVuln, idApp) VALUES (2, 3);
INSERT INTO contenir (idVuln, idApp) VALUES (1, 2);
INSERT INTO contenir (idVuln, idApp) VALUES (2, 1);
INSERT INTO contenir (idVuln, idApp) VALUES (1, 3);