/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  24/10/2023 17:14:30                      */
/*==============================================================*/


drop table if exists ACTIVITE;

drop table if exists ALIMENT;

drop table if exists APPORTER;

drop table if exists CONTENIR;

drop table if exists NUTRIMENTS;

drop table if exists PLAT;

drop table if exists REPAS;

drop table if exists REQUERIR;

drop table if exists TYPE;

drop table if exists USER;

/*==============================================================*/
/* Table : ACTIVITE                                             */
/*==============================================================*/
create table ACTIVITE
(
   ID_ACTIVITE          int not null,
   NOM_ACTIVITE         varchar(50) not null,
   primary key (ID_ACTIVITE)
);

/*==============================================================*/
/* Table : ALIMENT                                              */
/*==============================================================*/
create table ALIMENT
(
   ID_ALIMENT           int not null,
   NOM_ALIMENT          varchar(50) not null,
   primary key (ID_ALIMENT)
);

/*==============================================================*/
/* Table : APPORTER                                             */
/*==============================================================*/
create table APPORTER
(
   ID_NUTRIMENT         int not null,
   ID_ALIMENT           int not null,
   QUANTITE             int not null,
   primary key (ID_NUTRIMENT, ID_ALIMENT)
);

/*==============================================================*/
/* Table : CONTENIR                                             */
/*==============================================================*/
create table CONTENIR
(
   ID_ALIMENT           int not null,
   ID_REPAS             int not null,
   QUANTITE             int not null,
   primary key (ID_ALIMENT, ID_REPAS)
);

/*==============================================================*/
/* Table : NUTRIMENTS                                           */
/*==============================================================*/
create table NUTRIMENTS
(
   ID_NUTRIMENT         int not null,
   NOM_NUTRIMENT        int not null,
   primary key (ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : PLAT                                                 */
/*==============================================================*/
create table PLAT
(
   ID_PLAT              int not null,
   NOM_PLAT             varchar(50) not null,
   primary key (ID_PLAT)
);

/*==============================================================*/
/* Table : REPAS                                                */
/*==============================================================*/
create table REPAS
(
   ID_REPAS             int not null,
   ID_TYPE              int not null,
   ID_USER              int not null,
   DATE_REPAS           date,
   primary key (ID_REPAS)
);

/*==============================================================*/
/* Table : REQUERIR                                             */
/*==============================================================*/
create table REQUERIR
(
   ID_PLAT              int not null,
   ID_ALIMENT           int not null,
   POURCENTAGE          int not null,
   primary key (ID_PLAT, ID_ALIMENT)
);

/*==============================================================*/
/* Table : TYPE                                                 */
/*==============================================================*/
create table TYPE
(
   ID_TYPE              int not null,
   NOM_TYPE             varchar(50) not null,
   primary key (ID_TYPE)
);

/*==============================================================*/
/* Table : USER                                                 */
/*==============================================================*/
create table USER
(
   ID_USER              int not null,
   ID_ACTIVITE          int not null,
   NAME                 varchar(50) not null,
   POIDS                int not null,
   TAILLE               int not null,
   AGE                  int not null,
   PWD                  varchar(50) not null,
   SEXE                 char(1) not null,
   primary key (ID_USER)
);

alter table APPORTER add constraint FK_APPORTER foreign key (ID_NUTRIMENT)
      references NUTRIMENTS (ID_NUTRIMENT) on delete restrict on update restrict;

alter table APPORTER add constraint FK_APPORTER2 foreign key (ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update restrict;

alter table CONTENIR add constraint FK_CONTENIR foreign key (ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update restrict;

alter table CONTENIR add constraint FK_CONTENIR2 foreign key (ID_REPAS)
      references REPAS (ID_REPAS) on delete restrict on update restrict;

alter table REPAS add constraint FK_ETRE foreign key (ID_TYPE)
      references TYPE (ID_TYPE) on delete restrict on update restrict;

alter table REPAS add constraint FK_ETRE_MANGE foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table REQUERIR add constraint FK_REQUERIR foreign key (ID_PLAT)
      references PLAT (ID_PLAT) on delete restrict on update restrict;

alter table REQUERIR add constraint FK_REQUERIR2 foreign key (ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update restrict;

alter table USER add constraint FK_PRATIQUER foreign key (ID_ACTIVITE)
      references ACTIVITE (ID_ACTIVITE) on delete restrict on update restrict;

