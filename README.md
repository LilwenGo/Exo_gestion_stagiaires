# Projet de gestion de stages
### Procedure d'instalation:
- Installer WAMP ou équivalent.
- Aller sur PHPMyAdmin et importer le fichier DB.sql dans un base de données à nommer.
- Aller dans connexion.php et modifier le nom de la base si besoin.
- Inserer des formateurs, salles, types de formations, spécialités et nationalités dans PHPMyAdmin.
## Notes pour le prof:
- J'ai priorisé les commentaires aux dates que j'ai fait en dernier (je voulais privilegier la clareté du code à la coherence des dates) en effet je l'ai fait au cas ou je manque de temps.
- Les seuls moyens de changer les champs dates sont: le date picker, les flèches directionneles et les les flèches du pavé numerique.
- J'ai eu le temps de changer mon code pour que le stagiaire soit modifié avec un update plutot que de le remplacer par un nouveau avec insert.
- Dans les champs date j'ai mis une valeur par défaut: dans celui de début la date du jour, et dans celui de fin la date du jour + 90 jours.
- J'ai géré les multi-metiers des formateurs.
- Je sais que je suis très vulnérable avec l'inspecteur je penserais à l'unique id pour une prochaine fois.