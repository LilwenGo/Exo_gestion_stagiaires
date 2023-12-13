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

###### BD.sql
**Si besoin voici le code sql (j'ai des noms de champs differents)**
drop table if exists FORMATEUR;
drop table if exists FORMER;
drop table if exists NATIONALITE;
drop table if exists SALLE;
drop table if exists SPECIALISER;
drop table if exists STAGIAIRE;
drop table if exists TYPE_FORMATION;
create table FORMATEUR
(
   ID_FORMATEUR         int not null AUTO_INCREMENT,
   ID_SALLE             int not null,
   NOM                  varchar(20),
   PRENOM               varchar(20),
   primary key (ID_FORMATEUR)
);
create table FORMER
(
   ID_STAGIAIRE         int not null,
   ID_FORMATEUR         int not null,
   DATE_DEBUT           date,
   DATE_FIN             date,
   primary key (ID_STAGIAIRE, ID_FORMATEUR)
);
create table NATIONALITE
(
   ID_NATIONALITE       int not null AUTO_INCREMENT,
   LIBELLE_NATIONALITE  varchar(100),
   primary key (ID_NATIONALITE)
);
create table SALLE
(
   ID_SALLE             int not null AUTO_INCREMENT,
   LIBELLE_SALLE        varchar(100),
   primary key (ID_SALLE)
);
create table SPECIALISER
(
   ID_FORMATEUR         int not null,
   ID_TYPE              int not null,
   primary key (ID_FORMATEUR, ID_TYPE)
);
create table STAGIAIRE
(
   ID_STAGIAIRE         int not null AUTO_INCREMENT,
   ID_TYPE              int not null,
   ID_NATIONALITE       int not null,
   NOM_STAGIAIRE        varchar(20),
   PRENOM_STAGIAIRE     varchar(20),
   primary key (ID_STAGIAIRE)
);
create table TYPE_FORMATION
(
   ID_TYPE              int not null AUTO_INCREMENT,
   LIBELLE_TYPE         varchar(100),
   primary key (ID_TYPE)
);
ALTER TABLE FORMATEUR ENGINE = InnoDB;
ALTER TABLE FORMER ENGINE = InnoDB;
ALTER TABLE SPECIALISER ENGINE = InnoDB;
ALTER TABLE STAGIAIRE ENGINE = InnoDB;
ALTER TABLE NATIONALITE ENGINE = InnoDB;
ALTER TABLE SALLE ENGINE = InnoDB;
ALTER TABLE TYPE_FORMATION ENGINE = InnoDB;
alter table FORMATEUR add constraint FK_SE_TROUVER foreign key (ID_SALLE)
      references SALLE (ID_SALLE) on delete restrict on update restrict;
alter table FORMER add constraint FK_FORMER foreign key (ID_FORMATEUR)
      references FORMATEUR (ID_FORMATEUR) on delete cascade on update restrict;
alter table FORMER add constraint FK_FORMER2 foreign key (ID_STAGIAIRE)
      references STAGIAIRE (ID_STAGIAIRE) on delete restrict on update restrict;
alter table SPECIALISER add constraint FK_SPECIALISER foreign key (ID_TYPE)
      references TYPE_FORMATION (ID_TYPE) on delete restrict on update restrict;
alter table SPECIALISER add constraint FK_SPECIALISER2 foreign key (ID_FORMATEUR)
      references FORMATEUR (ID_FORMATEUR) on delete restrict on update restrict;
alter table STAGIAIRE add constraint FK_APPRENDRE foreign key (ID_TYPE)
      references TYPE_FORMATION (ID_TYPE) on delete restrict on update restrict;
alter table STAGIAIRE add constraint FK_AVOIR foreign key (ID_NATIONALITE)
      references NATIONALITE (ID_NATIONALITE) on delete restrict on update restrict;
