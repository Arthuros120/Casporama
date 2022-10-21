insert into utilisateur (login, password, status)
values
    ('root','CA$torama2022A','Administrateur'),
    ('arthur','arthur123','Administrateur'),
    ('maximef','maxime123','Administrateur'),
    ('maximes','maxime123','Administrateur'),
    ('titouan','titouan123','Administrateur'),
    ('michel','1234','Client'),
    ('michelle','1234','Caspor');

insert into coordonnees (id, prenom, nom, mail, mobile, fixe)
values
    (6,'michel','duponse','duponse@test.com',0602030405,0402030405),
    (7,'michelle','duponse','michelle@test.com',0602030404,0402030405);

insert into localisation (id, adresse, codepostal, ville, departement, pays)
values
    (6,'12 av du 35 juillet',44000,'Nantes','Loire-Atlantique','France'),
    (7,'12 av du 35 juillet',44000,'Nantes','Loire-Atlantique','France');

INSERT INTO sport (nom)
 VALUES
 ('football'),
 ('volleyball'),
 ('Badminton'),
 ('arts-martiaux');

insert into produit (reference, type, nusport, marque, nom, genre, prix, description, image)
values
    (4064,'Vêtement',1,'Nike','Maillot foot','Femme',99.99,'', '/upload/image/Football/MaillotTest.png'),
    (5064,'Chaussure',2,'Puma','Chaussure volley','Mixte',99.99,'','/upload/image/Volleyball/chaussure.png'),
    (6064,'Equipement',3,'Addidas','Raquette','Homme',99.99,'', '/upload/image/Badminton/raquette.jpg'),
    (7064,'Vêtement',1,'Nike','Maillot foot v2','Homme',99.99,'','/upload/image/Football/MaillotTest2.png');


insert into catalogue (nuproduit, couleur, taille, quantite)
values
    (1,'Rouge','XS',2),
    (2,'Bleu','35',1),
    (3,null,null,5),
    (1,'Vert','XS',2),
    (4,'Bleu','L',1);

insert into commande (datecommande, idproduit, quantite, idclient, etat)
values
    ('10/10/2022', 1, 1 ,6,'En preparation');



