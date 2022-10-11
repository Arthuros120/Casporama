CREATE TABLE IF NOT EXISTS utilisateur (
    id INTEGER NOT NULL,
    login VARCHAR(255) not null unique,
    password VARCHAR(255) NOT NULL,
    status VARCHAR(20) not null check (status in ('Administrateur','Client','Client Prime')),
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS coordonnees (
    id INTEGER NOT NULL,
    prenom VARCHAR(255) not null,
    nom VARCHAR(255) NOT NULL,
    mail VARCHAR(255) not null unique,
    mobile integer(10) not null unique,
    fixe integer(10) not null,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES utilisateur(id)
);

CREATE TABLE IF NOT EXISTS localisation (
    id INTEGER NOT NULL,
    adresse VARCHAR(255) not null,
    codepostal integer(5) NOT NULL,
    ville VARCHAR(255) not null,
    departement VARCHAR(255) not null,
    pays VARCHAR(255) not null,
    PRIMARY KEY (id),
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
    nusport integer not null unique,
    marque VARCHAR(255) not null,
    nom VARCHAR(255) NOT NULL UNIQUE,
    genre VARCHAR(5) NOT NULL check ( genre in ('Homme','Femme','Mixte') ),
    prix float not null,
    description varchar(255),
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
    detail varchar(255) not null unique,
    idclient integer not null unique,
    etat varchar(15) not null check ( etat in ('En cours','En preparation','Terminer') ),
    primary key (idcommande),
    foreign key (idclient) references utilisateur(id)
);