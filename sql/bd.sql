CREATE TABLE IF NOT EXISTS sport (
    nusport INTEGER NOT NULL,
    nom TEXT NOT NULL UNIQUE,
    PRIMARY KEY (nusport)
);

CREATE TABLE IF NOT EXISTS vetement (
    nuvetement INTEGER NOT NULL,
    nusport integer not null,
    nom TEXT NOT NULL UNIQUE,
    genre TEXT NOT NULL,
    prix float not null,
    PRIMARY KEY (nuvetement),
    FOREIGN KEY (nusport) REFERENCES sport(nusport)
);

CREATE TABLE IF NOT EXISTS stock (
    nuproduit INTEGER NOT NULL,
    nbXS integer not null DEFAULT 0,
    nbS integer not null DEFAULT 0,
    nbM integer not null DEFAULT 0,
    nbL integer not null DEFAULT 0,
    nbXL integer not null DEFAULT 0,
    nbXXL integer not null DEFAULT 0,
    PRIMARY KEY (nuproduit)
);

CREATE TABLE IF NOT EXISTS chaussure (
    nuchaussure INTEGER NOT NULL,
    nusport integer not null,
    nom TEXT NOT NULL UNIQUE,
    genre TEXT NOT NULL,
    prix float not null,
    PRIMARY KEY (nuchaussure),
    FOREIGN KEY (nusport) REFERENCES sport(nusport),
    FOREIGN KEY (nuchaussure) REFERENCES stock(nuproduit)
);

CREATE TABLE IF NOT EXISTS equipement (
    nuequipement INTEGER NOT NULL,
    nusport integer not null,
    nom TEXT NOT NULL UNIQUE,
    prix float not null,
    PRIMARY KEY (nuequipement),
    FOREIGN KEY (nusport) REFERENCES sport(nusport),
    FOREIGN KEY (nuequipement) REFERENCES stock(nuproduit)
);


CREATE TABLE IF NOT EXISTS utilisateur (
    id INTEGER NOT NULL,
    login TEXT not null unique,
    password TEXT NOT NULL UNIQUE,
    status text not null,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS coordonnees (
    id INTEGER NOT NULL,
    prenom TEXT not null,
    nom TEXT NOT NULL,
    mail text not null unique,
    mobile integer not null unique,
    fixe integer not null unique,
    PRIMARY KEY (id)
    FOREIGN KEY (id) REFERENCES utilisateur(id)
);

CREATE TABLE IF NOT EXISTS localisation (
    id INTEGER NOT NULL,
    adresse TEXT not null,
    codepostal integer NOT NULL,
    ville text not null,
    departement text not null,
    pays text not null,
    PRIMARY KEY (id)
    FOREIGN KEY (id) REFERENCES utilisateur(id)
);
