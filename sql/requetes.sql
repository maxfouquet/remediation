-- Afficher les vulnérabilités triées par severite
SELECT * FROM vulnerabilite ORDER BY severite DESC;

-- Afficher les vulnérabilités de l'application "Pégase"
SELECT description, nomApp, descriptionApp, etat, severite FROM vulnerabilite 
JOIN contenir ON vulnerabilite.idVuln = contenir.idVuln
JOIN application ON application.idApp = contenir.idApp
WHERE application.nomApp = "Pégase"
ORDER BY severite DESC;

-- Afficher le nombre de vulnérabilités par application
SELECT application.nomApp as "Application", count(*) as "Nombre de vulnérabilités" FROM vulnerabilite
RIGHT JOIN contenir ON vulnerabilite.idVuln = contenir.idVuln
RIGHT JOIN application ON application.idApp = contenir.idApp
GROUP BY application.nomApp;

-- Afficher le détail de la vulnérabilité SQLi
SELECT * FROM vulnerabilite WHERE idVuln = 3;