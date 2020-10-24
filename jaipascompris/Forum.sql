Drop database if exists Forum ;
create database Forum ;
  use Forum ;

create table utilisateurs(
   id int(3) not null auto_increment,
   Nom varchar(50),
   Prenom varchar(50),
   Surnom varchar(50),
   age int(2),
   Genre varchar(50),
   mail varchar(50),
   password int(10),
   primary key(id)
);
  
  insert into utilisateurs (id, Nom, Prenom, Surnom, age, Genre, mail, password) values
  (1, 'Vignon', 'Nicolas', 'Kata9467', '19', 'Homme', 'nicolas.vignon@moniris.com', '92800'),
  (2, 'Doll', 'Adrien', 'RoroS3188', '19', 'Homme', 'adrien.doll@moniris.com', '78420'),
  (3, 'Delacroix', 'Adrien', 'Aura1918', '20', 'Homme', 'adrien.delacroix@moniris.com', '75020');


create table Categorie(
   id_Cat int(50) not null auto_increment,
   Theme varchar(50),
   primary key(id_Cat)
);

  insert into Categorie (id_Cat, Theme) values
  (1, "JeuxVideo/Plateaux"),
  (2, "Mode/Sneakers"),
  (3, "Sports");


create table sujet(
   id_sujet int(50) not null auto_increment,
   titre varchar(50),
   description varchar(50),
   id_Cat int(50) not null,
   primary key(id_sujet),
   foreign key(id_Cat) references Categorie (id_Cat)
);

create table Message(
   id_message int(50) not null auto_increment,
   Contenu varchar(280),
   date_message date,
   id_sujet int(50) not null,
   id int(3) not null,
   primary key(id_message),
   foreign key(id_sujet) references sujet (id_sujet),
   foreign key(id) references utilisateurs (id)
);
