use Casporama;

insert into utilisateur (id, login, password, salt, status)
values
    (1,'root','$2y$10$MCDgDzmwpaP.JVNIU5zZluM2fgms.ev5i2cOVK5EmEwbcQhamHMYy','117503329635307be4a2976.09876691','Administrateur'), -- CA$torama2022A
    (2,'arthur','$2y$10$2A4swofgoN/cg8bZYMk9fe6rvys6To1fIDJQiMBeGuusRPYsvPaIK','561630926353082e643284.05064160','Administrateur'), -- arthur123
    (3,'maximef','$2y$10$0hr30fUMXc3JvBdBPg2c7O0usKf4Kz5szidUmVpAqNdzK1fvKfjmC','16911063756353084b2bba54.99559659','Administrateur'), -- maxime123
    (4,'maximes','$2y$10$CpJ8tVdCdgY7c0npGR6NzeV6wAVQSdXfCWl8OlMgbShPv.Wdh8X2W','132452177363530853c62e81.40022211','Administrateur'), -- maxime123
    (5,'titouan','$2y$10$sInu14PLYWwRQ0Mmo/31EuPoF6gy1zmJueU6F9Pmc8Ops42gDDG..','1184225843635308612f6222.30318460','Administrateur'), -- titouan123
    (6,'michel','$2y$10$Po1OOq1FZmxVV9v4mMFWwOR4ZbDtKQaZGFZ/ttEJhwSMfjfjU.yj.','1878903195635308709421d5.58691612','Client'), -- client1234
    (7,'michelle','$2y$10$bGRZi8h7Yvef/iQ0GcWBwed38pAA6iK0Ss6US/bpVVI0OkNjyvdIK','4849665063530884cfa935.33716248','Caspor'); -- client1234

insert into coordonnees (id, prenom, nom, mail, mobile, fixe)
values
    (2,'Arthur','Hamelin','arthur.hamelin@etu.univ-nantes.fr','0600000000','0200000000'),
    (6,'michel','duponse','duponse@test.com','0602030405','0402030405'),
    (7,'michelle','duponse','michelle@test.com','0602030404','0402030405');

insert into localisation (idadresse,id , adresse, codepostal, ville, departement, pays)
values
    (1,6,'12 av du 35 juillet','44000','Nantes','Loire-Atlantique','France'),
    (2,7,'12 av du 35 juillet','44000','Nantes','Loire-Atlantique','France');

INSERT INTO sport (nusport,nom)
 VALUES
 (1,'Football'),
 (2,'Volleyball'),
 (3,'Badminton'),
 (4,'Arts-martiaux');

insert into produit (idproduit, reference, type, nusport, marque, nom, genre, prix, description, image)
values
    (   1,
        4064,
        'Vêtement',
        1,
        'Nike',
        'Maillot foot',
        'Femme',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
        '/upload/image/Football/MaillotTest.png;/upload/image/Football/MaillotTest2.png;/upload/image/Football/MaillotTest.png;/upload/image/Football/MaillotTest2.png'
     ),
    (
        2,
        5064,
        'Chaussure',
        2,
        'Puma',
        'Chaussure volley',
        'Mixte',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
         '/upload/image/Volleyball/chaussure.png;/upload/image/Volleyball/chaussure.png;/upload/image/Volleyball/chaussure.png;/upload/image/Volleyball/chaussure.png'
         ),
    (
        3,
        6064,
        'Equipement',
        3,
        'Addidas',
        'Raquette',
        'Homme',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
         '/upload/image/Badminton/raquette.jpg;/upload/image/Badminton/raquette.jpg;/upload/image/Badminton/raquette.jpg;/upload/image/Badminton/raquette.jpg'
         ),
    (
        4,
        7064,
        'Vêtement',
        1,
        'Nike',
        'Maillot foot v2',
        'Homme',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
        '/upload/image/Football/MaillotTest2.png;/upload/image/Football/MaillotTest.png;/upload/image/Football/MaillotTest2.png;/upload/image/Football/MaillotTest.png'
         );


insert into catalogue (id, nuproduit, couleur, taille, quantite)
values
    (1,1,'Rouge','XS',2),
    (2,2,'Bleu','35',1),
    (3,3,null,null,5),
    (4,1,'Vert','XS',2),
    (5,4,'Bleu','L',1);

insert into commande (idcommande,datecommande, idproduit, quantite, idclient,idadresse , etat)
values
    (1,'10/10/2022', 1, 1 ,6,1,'En preparation');



