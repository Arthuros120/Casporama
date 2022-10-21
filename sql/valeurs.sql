insert into utilisateur (login, password, salt, status)
values
    ('root','$2y$10$MCDgDzmwpaP.JVNIU5zZluM2fgms.ev5i2cOVK5EmEwbcQhamHMYy','117503329635307be4a2976.09876691','Administrateur'), -- CA$torama2022A
    ('arthur','$2y$10$2A4swofgoN/cg8bZYMk9fe6rvys6To1fIDJQiMBeGuusRPYsvPaIK','561630926353082e643284.05064160','Administrateur'), -- arthur123
    ('maximef','$2y$10$0hr30fUMXc3JvBdBPg2c7O0usKf4Kz5szidUmVpAqNdzK1fvKfjmC','16911063756353084b2bba54.99559659','Administrateur'), -- maxime123
    ('maximes','$2y$10$CpJ8tVdCdgY7c0npGR6NzeV6wAVQSdXfCWl8OlMgbShPv.Wdh8X2W','132452177363530853c62e81.40022211','Administrateur'), -- maxime123
    ('titouan','$2y$10$sInu14PLYWwRQ0Mmo/31EuPoF6gy1zmJueU6F9Pmc8Ops42gDDG..','1184225843635308612f6222.30318460','Administrateur'), -- titouan123
    ('michel','$2y$10$Po1OOq1FZmxVV9v4mMFWwOR4ZbDtKQaZGFZ/ttEJhwSMfjfjU.yj.','1878903195635308709421d5.58691612','Client'), -- client1234
    ('michelle','$2y$10$bGRZi8h7Yvef/iQ0GcWBwed38pAA6iK0Ss6US/bpVVI0OkNjyvdIK','4849665063530884cfa935.33716248','Caspor'); -- client1234

insert into coordonnees (id, prenom, nom, mail, mobile, fixe)
values
    (6,'michel','duponse','duponse@test.com','0602030405','0402030405'),
    (7,'michelle','duponse','michelle@test.com','0602030404','0402030405');

insert into localisation (id, adresse, codepostal, ville, departement, pays)
values
    (6,'12 av du 35 juillet','44000','Nantes','Loire-Atlantique','France'),
    (7,'12 av du 35 juillet','44000','Nantes','Loire-Atlantique','France');

INSERT INTO sport (nom)
 VALUES
 ('Football'),
 ('Volleyball'),
 ('Badminton'),
 ('Arts-martiaux');

insert into produit (reference, type, nusport, marque, nom, genre, prix, description, image)
values
    (
        4064,
        'Vêtement',
        1,
        'Nike',
        'Maillot foot',
        'Femme',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
        '/upload/image/Football/MaillotTest.png;
        /upload/image/Football/MaillotTest2.png;
        /upload/image/Football/MaillotTest.png;
        /upload/image/Football/MaillotTest2.png'
     ),
    (
        5064,
        'Chaussure',
        2,
        'Puma',
        'Chaussure volley',
        'Mixte',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
         '/upload/image/Volleyball/chaussure.png'
         ),
    (
        6064,
        'Equipement',
        3,
        'Addidas',
        'Raquette',
        'Homme',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
         '/upload/image/Badminton/raquette.jpg'
         ),
    (
        7064,
        'Vêtement',
        1,
        'Nike',
        'Maillot foot v2',
        'Homme',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
        '/upload/image/Football/MaillotTest2.png;
         /upload/image/Football/MaillotTest.png;
         /upload/image/Football/MaillotTest2.png;
         /upload/image/Football/MaillotTest.png'
         );


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



