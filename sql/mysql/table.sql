create database if not exists Casporama;
use Casporama;

CREATE TABLE IF NOT EXISTS utilisateur (
    id INTEGER NOT NULL,
    login VARCHAR(255) not null unique,
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(45) NOT NULL unique,
    cookieId VARCHAR(45),
    status VARCHAR(20) not null check (status in ('Administrateur','Client','Caspor')),
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS coordonnees (
    id INTEGER NOT NULL,
    prenom VARCHAR(255),
    nom VARCHAR(255),
    mail VARCHAR(255) unique,
    mobile varchar(10)  unique,
    fixe varchar(10),
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES utilisateur(id)
);

CREATE TABLE IF NOT EXISTS localisation (
    idadresse int not null unique,
    id INTEGER NOT NULL,
    adresse VARCHAR(255) not null,
    codepostal varchar(5) NOT NULL,
    ville VARCHAR(255) not null,
    departement VARCHAR(255) not null,
    pays VARCHAR(255) not null,
    PRIMARY KEY (idadresse),
    FOREIGN KEY (id) REFERENCES utilisateur(id)
);

CREATE TABLE IF NOT EXISTS sport (
    nusport INTEGER NOT NULL,
    nom VARCHAR(20) NOT NULL UNIQUE,
    PRIMARY KEY (nusport)
);


create table if not exists produit (
    idproduit integer not null,
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
    id INTEGER NOT NULL,
    nuproduit integer not null,
    couleur varchar(20),
    taille varchar(3),
    quantite integer not null default 0,
    PRIMARY KEY (id),
    foreign key (nuproduit) references produit(idproduit)
);

create table if not exists commande (
    idcommande integer not null,
    datecommande varchar(10) not null,
    idproduit integer not null,
    quantite integer not null,
    idclient integer not null,
    idadresse int not null,
    etat varchar(15) not null check ( etat in ('En cours','En preparation','Terminer') ),
    primary key (idcommande),
    foreign key (idadresse) references localisation(idadresse),
    foreign key (idclient) references utilisateur(id),
    foreign key (idproduit) references produit(idproduit)
);

-- Ajout de la table captcha pour la gestion des captcha
CREATE TABLE captcha (
	captcha_id bigint unsigned NOT NULL auto_increment,
	captcha_time int unsigned NOT NULL,
	ip_address varchar(45) NOT NULL,
	word varchar(20) NOT NULL,
	PRIMARY KEY `captcha_id` (`captcha_id`),
	KEY `word` (`word`)
);
