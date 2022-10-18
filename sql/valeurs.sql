insert into utilisateur (id, login, password, status)
values
    (1,'root','CA$torama2022A','Administrateur'),
    (2,'arthur','arthur123','Administrateur'),
    (3,'maximef','maxime123','Administrateur'),
    (4,'maximes','maxime123','Administrateur'),
    (5,'titouan','titouan123','Administrateur'),
    (6,'michel','1234','Client'),
    (7,'michelle','1234','Client Prime');

insert into coordonnees (id, prenom, nom, mail, mobile, fixe)
values
    (6,'michel','duponse','duponse@test.com',0602030405,0402030405),
    (7,'michelle','duponse','michelle@test.com',0602030404,0402030405);

insert into localisation (id, adresse, codepostal, ville, departement, pays)
values
    (6,'12 av du 35 juillet',44000,'Nantes','Loire-Atlantique','France'),
    (7,'12 av du 35 juillet',44000,'Nantes','Loire-Atlantique','France');

INSERT INTO sport (nusport, nom)
 VALUES
 (1,'football'),
 (2, 'volleyball'),
 (3, 'Badminton'),
 (4, 'arts-martiaux');

insert into produit (idproduit, reference, type, nusport, marque, nom, genre, prix, description, image)
values
    (1,4064,'Vêtement',1,'Nike','Maillot foot','Femme',99.99,'', '/upload/image/Football/MaillotTest.png'),
    (2,5064,'Chaussure',2,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (3,6064,'Equipement',3,'Addidas','Raquette','Homme',99.99,'',null),
    (4,7064,'Vêtement',4,'Nike','Maillot foot','Homme',99.99,'',null),
    (5,8064,'Chaussure',1,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (6,9064,'Equipement',2,'Addidas','Raquette','Homme',99.99,'',null),
    (7,10064,'Vêtement',3,'Nike','Maillot foot','Femme',99.99,'',null),
    (8,11064,'Chaussure',4,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (9,12064,'Equipement',1,'Addidas','Raquette','Homme',99.99,'',null),
    (10,13064,'Vêtement',2,'Nike','Maillot foot','Homme',99.99,'',null),
    (11,14064,'Chaussure',3,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (12,15064,'Equipement',4,'Addidas','Raquette','Homme',99.99,'',null),
    (13,16064,'Vêtement',1,'Nike','Maillot foot','Femme',99.99,'',null),
    (14,17064,'Chaussure',2,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (15,18064,'Equipement',3,'Addidas','Raquette','Homme',99.99,'',null),
    (16,19064,'Vêtement',4,'Nike','Maillot foot','Homme',99.99,'',null),
    (17,20064,'Chaussure',1,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (18,21064,'Equipement',2,'Addidas','Raquette','Homme',99.99,'',null),
    (19,22064,'Vêtement',3,'Nike','Maillot foot','Femme',99.99,'',null),
    (20,23064,'Chaussure',4,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (21,24064,'Equipement',1,'Addidas','Raquette','Homme',99.99,'' ,null),
    (22,25064,'Vêtement',2,'Nike','Maillot foot','Homme',99.99,'',null),
    (23,26064,'Chaussure',3,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (24,27064,'Equipement',4,'Addidas','Raquette','Homme',99.99,'',null),
    (25,28064,'Vêtement',1,'Nike','Maillot foot','Femme',99.99,'',null),
    (26,29064,'Chaussure',2,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (27,30064,'Equipement',3,'Addidas','Raquette','Homme',99.99,'',null),
    (28,31064,'Vêtement',4,'Nike','Maillot foot','Homme',99.99,'',null),
    (29,32064,'Chaussure',1,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (30,33064,'Equipement',2,'Addidas','Raquette','Homme',99.99,'',null),
    (31,34064,'Vêtement',3,'Nike','Maillot foot','Femme',99.99,'',null),
    (32,35064,'Chaussure',4,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (33,36064,'Equipement',1,'Addidas','Raquette','Homme',99.99,'',null),
    (34,37064,'Vêtement',2,'Nike','Maillot foot','Homme',99.99,'',null),
    (35,38064,'Chaussure',3,'Puma','Chaussure volley','Mixte',99.99,'',null),
    (36,39064,'Equipement',4,'Addidas','Raquette','Homme',99.99,'',null),
    (37,40064,'Vêtement',1,'Nike','Maillot foot','Femme',99.99,'',null);


insert into catalogue (id, nuproduit, couleur, taille, quantite)
values
    (1,1,'Rouge','XS',2),
    (2,2,'Bleu','35',1),
    (3,3,null,null,5),
    (4,1,'Vert','XS',2);

insert into commande (idcommande, datecommande, idproduit, quantite, idclient, etat)
values
    (1,'10/10/2022', 1, 1 ,6,'En preparation');



