create database takalo_takalo;
use takalo_takalo;


create table user(
    id_user int auto_increment primary key,
    name varchar(200),
    email varchar(200),
    status varchar(100),
    phone varchar(15),
    join_date date,
    last_active varchar(200),
    pwd varchar(200),
    role ENUM('admin','user') DEFAULT 'user'
);

create table discussion(
    id_discussion int auto_increment primary key,
    title varchar(200),
    id_user1 int,
    id_user2 int,
    date_creation date,
    foreign key (id_user1) references user(id_user),
    foreign key (id_user2) references user(id_user)
);

create table messages(
    id_message int auto_increment primary key,
    id_discussion int,
    id_sender int,
    contenue text,
    date_envoie date,
    seen_at datetime null,
    foreign key (id_discussion) references discussion(id_discussion),
    foreign key (id_sender) references user(id_user)
);

alter table user drop column last_active; 
alter table user add column last_active datetime; 
alter table messages add column seen_at datetime null; 




create table categorie(
    id_categorie int auto_increment primary key,
    nom_categorie varchar(200) not null unique
);

create table objets(
    id_objet int auto_increment primary key,
    id_proprietaire int not null,
    id_categorie int not null,
    title varchar(200),
    description text,
    prix_estime decimal(10,2),
    date_creation datetime,
    foreign key (id_proprietaire) references user(id_user),
    foreign key (id_categorie) references categorie(id_categorie)
);

create table objet_img(
    id_objet_img int auto_increment primary key,
    id_objet int not null,
    image varchar(200) not null,
    foreign key (id_objet) references objets(id_objet)
);


create table echanges(
    id_echange int auto_increment primary key,
    id_proposeur int not null,
    id_receveur int not null,
    objet_proposer int not null,
    objet_requise int not null,
    status ENUM('attente','accepter','refuser') DEFAULT 'attente',
    date_proposition datetime,
    foreign key(id_proposeur) references user(id_user),
    foreign key(id_receveur) references user(id_user),
    foreign key(objet_proposer) references objets(id_objet),
    foreign key(objet_requise) references objets(id_objet)
);

create table objet_history(
    id_objet_history int auto_increment primary key,
    id_objet int not null,
    id_proprietaire int not null,
    id_echange int not null,
    date_echange datetime,
    foreign key(id_objet) references objets (id_objet),
    foreign key(id_proprietaire) references user (id_user),
    foreign key(id_echange) references echanges (id_echange),
);
