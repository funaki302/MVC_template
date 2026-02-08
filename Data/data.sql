DROP DATABASE IF EXISTS MVC_template;

CREATE DATABASE MVC_template CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE MVC_template;

create table user(
    id_user int auto_increment primary key,
    name varchar(200),
    email varchar(200),
    role varchar(100),
    status varchar(100),
    department varchar(200),
    phone varchar(15),
    join_date date,
    last_active varchar(200),
    pwd varchar(200)
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


