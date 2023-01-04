Create database if not exists CasporamaDEV;
Create database if not exists Casporama;

use CasporamaDEV;

CREATE TABLE IF NOT EXISTS user (
    id INTEGER NOT NULL,
    login VARCHAR(255) not null unique,
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(45) NOT NULL unique,
    cookieId VARCHAR(45),
    status VARCHAR(20) not null,
    isVerified bool not null,
    isALive bool not null,
    dateLastUpdate datetime not null,
    constraint status_not_valid
        check(status in ('Administrateur','Client','Caspor')),
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS information (
    id INTEGER NOT NULL,
    firstname VARCHAR(255),
    name VARCHAR(255),
    mail VARCHAR(255) unique,
    mobile varchar(10) unique,
    fix varchar(10),
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS location (
    idlocation int not null unique,
    id INTEGER NOT NULL,
    name VARCHAR(255) not null,
    location VARCHAR(255) not null,
    codepostal varchar(5) NOT NULL,
    city VARCHAR(255) not null,
    department VARCHAR(255) not null,
    country VARCHAR(255) not null,
    latitude double,
    longitude double,
    isDefault bool,
    isALive bool not null,
    dateLastUpdate datetime not null,

    PRIMARY KEY(idlocation),
    FOREIGN KEY(id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS sport (
    nusport INTEGER NOT NULL,
    name VARCHAR(20) NOT NULL UNIQUE,
    PRIMARY KEY(nusport)
);


create table if not exists product (
    idproduct integer not null,
    type varchar(15) not null,
    nusport integer not null,
    brand VARCHAR(255) not null,
    name VARCHAR(255) NOT NULL UNIQUE,
    gender VARCHAR(5) NOT NULL,
    price float not null,
    description text not null,
    image text not null,
    isALive bool not null,
    dateLastUpdate datetime not null,
    PRIMARY KEY(idproduct),
    FOREIGN KEY(nusport) REFERENCES sport(nusport),
    constraint type_not_valid
        check( type in ('Vêtement','Chaussure','Equipement') ),
    constraint gender_not_valid
        check( gender in ('Homme','Femme','Mixte'))
);

CREATE TABLE IF NOT EXISTS catalog (
    id INTEGER NOT NULL,
    nuproduct integer not null,
    reference long not null,
    color varchar(20),
    size varchar(3),
    quantity integer not null default 0,
    isALive bool not null,
    dateLastUpdate datetime not null,
    PRIMARY KEY(id),
    foreign key(nuproduct) references product(idproduct)
);

create table if not exists `order` (
    id int not null,
    iduser int not null,
    dateorder date not null,
    idlocation int not null,
    state varchar(15) not null,
    isALive bool not null,
    dateLastUpdate datetime not null,
    primary key(id),
    foreign key(idlocation) references location(idlocation),
    foreign key(iduser) references user(id),
    constraint status_not_valid
        check(state in ('Non preparer','En preparation','Preparer','Expedier'))
);

create table if not exists order_products (
    idorder int not null,
    idproduct int not null,
    idvariant int not null,
    quantity int not null,
    primary key (idorder, idproduct,idvariant),
    foreign key (idvariant) references catalog(id)


);

-- Ajout de la table captcha pour la gestion des captcha
CREATE TABLE if not exists captcha (
	captcha_id bigint unsigned NOT NULL auto_increment,
	captcha_time int unsigned NOT NULL,
	ip_address varchar(45) NOT NULL,
	word varchar(20) NOT NULL,
	PRIMARY KEY `captcha_id` (`captcha_id`),
	KEY `word` (`word`)
);

Create table if not exists verifKey (
    id varchar(64) not null,
    keyValue VARCHAR(6) not null unique,
    dateCreation datetime not null,
    dateExpiration datetime not null,
    idUser INTEGER not null,
    constraint fk_verifKey_user
        foreign key (idUser) references user(id),
    PRIMARY KEY (id)
);

create table if not exists cart (
                                    id int not null unique,
                                    iduser int not null,
                                    idcart int not null,
                                    idvariant int not null,
                                    quantity int not null,
                                    date datetime not null,
                                    dateExp datetime not null,
                                    primary key (id),
                                    constraint fk_cart_user
                                        foreign key (iduser) references user(id),
                                    constraint fk_cart_product
                                        foreign key (idvariant) references catalog(id)
);
