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
    (3,6064,'Equipement',3,'Addidas','Raquette','Homme',99.99,'',null);

insert into catalogue (id, nuproduit, couleur, taille, quantite)
values
    (1,1,'Rouge','XS',2),
    (2,2,'Bleu','35',1),
    (3,3,null,null,5),
    (4,1,'Vert','XS',2);

insert into commande (idcommande, datecommande, idproduit, quantite, idclient, etat)
values
    (1,'10/10/2022', 1, 1 ,6,'En preparation');



