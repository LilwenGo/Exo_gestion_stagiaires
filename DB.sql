/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  07/12/2023 16:21:33                      */
/*==============================================================*/


drop table if exists FORMATEUR;

drop table if exists FORMER;

drop table if exists NATIONALITE;

drop table if exists SALLE;

drop table if exists SPECIALISER;

drop table if exists STAGIAIRE;

drop table if exists TYPE_FORMATION;

/*==============================================================*/
/* Table : FORMATEUR                                            */
/*==============================================================*/
create table FORMATEUR
(
   ID_FORMATEUR         int not null AUTO_INCREMENT,
   ID_SALLE             int not null,
   NOM                  varchar(20),
   PRENOM               varchar(20),
   primary key (ID_FORMATEUR)
);

/*==============================================================*/
/* Table : FORMER                                               */
/*==============================================================*/
create table FORMER
(
   ID_STAGIAIRE         int not null AUTO_INCREMENT,
   ID_FORMATEUR         int not null,
   DATE_DEBUT           date,
   DATE_FIN             date,
   primary key (ID_STAGIAIRE, ID_FORMATEUR)
);

/*==============================================================*/
/* Table : NATIONALITE                                          */
/*==============================================================*/
create table NATIONALITE
(
   ID_NATIONALITE       int not null AUTO_INCREMENT,
   LIBELLE_NATIONALITE  varchar(100),
   primary key (ID_NATIONALITE)
);

/*==============================================================*/
/* Table : SALLE                                                */
/*==============================================================*/
create table SALLE
(
   ID_SALLE             int not null AUTO_INCREMENT,
   LIBELLE_SALLE        varchar(100),
   primary key (ID_SALLE)
);

/*==============================================================*/
/* Table : SPECIALISER                                          */
/*==============================================================*/
create table SPECIALISER
(
   ID_FORMATEUR         int not null,
   ID_TYPE              int not null,
   primary key (ID_FORMATEUR, ID_TYPE)
);

/*==============================================================*/
/* Table : STAGIAIRE                                            */
/*==============================================================*/
create table STAGIAIRE
(
   ID_STAGIAIRE         int not null AUTO_INCREMENT,
   ID_TYPE              int not null,
   ID_NATIONALITE       int not null,
   NOM_STAGIAIRE        varchar(20),
   PRENOM_STAGIAIRE     varchar(20),
   primary key (ID_STAGIAIRE)
);

/*==============================================================*/
/* Table : TYPE_FORMATION                                       */
/*==============================================================*/
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
      references FORMATEUR (ID_FORMATEUR) on delete restrict on update restrict;

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

