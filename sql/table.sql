create database if not exists Casporama;
use Casporama;

CREATE TABLE IF NOT EXISTS utilisateur (
    id INTEGER NOT NULL auto_increment,
    login VARCHAR(255) not null unique,
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(45) NOT NULL unique,
    cookieId VARCHAR(45) unique,
    status VARCHAR(20) not null check (status in ('Administrateur','Client','Caspor')),
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS coordonnees (
    id INTEGER NOT NULL,
    prenom VARCHAR(255) not null,
    nom VARCHAR(255) NOT NULL,
    mail VARCHAR(255) not null unique,
    mobile varchar(10) not null unique,
    fixe varchar(10) not null,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES utilisateur(id)
);

CREATE TABLE IF NOT EXISTS localisation (
    id INTEGER NOT NULL,
    adresse VARCHAR(255) not null,
    codepostal varchar(5) NOT NULL,
    ville VARCHAR(255) not null,
    departement VARCHAR(255) not null,
    pays VARCHAR(255) not null,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES utilisateur(id)
);

CREATE TABLE IF NOT EXISTS sport (
    nusport INTEGER NOT NULL auto_increment,
    nom VARCHAR(20) NOT NULL UNIQUE,
    PRIMARY KEY (nusport)
);


create table if not exists produit (
    idproduit integer not null auto_increment,
    reference integer not null,
    type varchar(15) not null check ( type in ('Vêtement','Chaussure','Equipement') ),
    nusport integer not null,
    marque VARCHAR(255) not null,
    nom VARCHAR(255) NOT NULL UNIQUE,
    genre VARCHAR(5) NOT NULL check ( genre in ('Homme','Femme','Mixte') ),
    prix float not null,
    description text not null,
    image VARCHAR(255),
    PRIMARY KEY (idproduit),
    FOREIGN KEY (nusport) REFERENCES sport(nusport)
);

CREATE TABLE IF NOT EXISTS catalogue (
    id INTEGER NOT NULL auto_increment,
    nuproduit integer not null,
    couleur varchar(20),
    taille varchar(3),
    quantite integer not null default 0,
    PRIMARY KEY (id),
    foreign key (nuproduit) references produit(idproduit)
);

create table if not exists commande (
    idcommande integer not null auto_increment,
    datecommande varchar(10) not null,
    idproduit integer not null,
    quantite integer not null,
    idclient integer not null,
    etat varchar(15) not null check ( etat in ('En cours','En preparation','Terminer') ),
    primary key (idcommande),
    foreign key (idclient) references utilisateur(id),
    foreign key (idproduit) references produit(idproduit)
);



