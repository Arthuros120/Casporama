use CasporamaDEV;

insert into user (id, login, password, salt, status, isVerified, isALive, dateLastUpdate)
values
    (1,'root','$2y$10$MCDgDzmwpaP.JVNIU5zZluM2fgms.ev5i2cOVK5EmEwbcQhamHMYy','117503329635307be4a2976.09876691','Administrateur', true, true, '2022-12-06 14:59:37'), -- CA$torama2022A
    (2,'arthur','$2y$10$2A4swofgoN/cg8bZYMk9fe6rvys6To1fIDJQiMBeGuusRPYsvPaIK','561630926353082e643284.05064160','Administrateur', true, true, '2022-12-06 14:59:37'), -- arthur123
    (3,'maximef','$2y$10$0hr30fUMXc3JvBdBPg2c7O0usKf4Kz5szidUmVpAqNdzK1fvKfjmC','16911063756353084b2bba54.99559659','Administrateur', true, true, '2022-12-06 14:59:37'), -- maxime123
    (4,'maximes','$2y$10$CpJ8tVdCdgY7c0npGR6NzeV6wAVQSdXfCWl8OlMgbShPv.Wdh8X2W','132452177363530853c62e81.40022211','Administrateur', true, true, '2022-12-06 14:59:37'), -- maxime123
    (5,'titouan','$2y$10$sInu14PLYWwRQ0Mmo/31EuPoF6gy1zmJueU6F9Pmc8Ops42gDDG..','1184225843635308612f6222.30318460','Administrateur', true, true, '2022-12-06 14:59:37'), -- titouan123
    (6,'michel','$2y$10$Po1OOq1FZmxVV9v4mMFWwOR4ZbDtKQaZGFZ/ttEJhwSMfjfjU.yj.','1878903195635308709421d5.58691612','Client', true, true, '2022-12-06 14:59:37'), -- client1234
    (7,'michelle','$2y$10$bGRZi8h7Yvef/iQ0GcWBwed38pAA6iK0Ss6US/bpVVI0OkNjyvdIK','4849665063530884cfa935.33716248','Caspor', true, true, '2022-12-06 14:59:37'); -- client1234

insert into information (id, firstname, name, mail, mobile, fix)
values
    (2,'Arthur','Hamelin','arthur.hamelin@etu.univ-nantes.fr','1922422810','1569137250'),
    (3,'Maxime','Franco', 'maxime.franco@etu.univ-nantes.fr', '1922422811', '1569137251'),
    (4,'Maxime','Santos', 'maxime.santos@etu.univ-nantes.fr', '1922422812', '1569137252'),
    (5, 'Titouan', 'Gautier', 'titouan.gautier@etu.univ-nantes.fr', '1922422813', '1569137253'),
    (6,'Michelle','Dupont','dupont@test.com','1922422814','1569137254'),
    (7,'Jackie','Michelle','jackiemichelle@test.com','1922422815','1569137255');

insert into location (idlocation, id, name, location, codepostal, city, department, country, latitude, longitude, isDefault, isALive, dateLastUpdate)
values
    (1, 6, 'domicile', '12;av du 35 juillet','44000','Nantes','Loire-Atlantique','France', null, null, true, true, '2022-11-21 20:05:37'),
    (2, 7, 'domicile','12;av du 35 juillet','44000','Nantes','Loire-Atlantique','France', null, null, true, true, '2022-11-21 20:05:37'),
    (3, 2, 'local', '22;Rue des bergeronnettes','44210','Pornic','Loire-Atlantique','France', null, null, true, true, '2022-11-21 20:05:37'),
    (4, 2, 'domicile', '190;Boulevard Jules Vernes','44300','Nantes','Loire-Atlantique','France', 47.246678, -1.523291, false, true, '2022-11-21 20:05:37'),
    (5, 2, 'Apartement', '4;Avenue Michel Ange','44300','Nantes','Loire-Atlantique','France', null, null, false, false, '2022-11-21 20:05:37');

INSERT INTO sport (nusport,name)
 VALUES
 (1,'Football'),
 (2,'Volleyball'),
 (3,'Badminton'),
 (4,'Arts-martiaux');

insert into product (idproduct, type, nusport, brand, name, gender, price, description, image, isALive, dateLastUpdate)
values
    (   1,
        'Vêtement',
        1,
        'Nike',
        'Maillot foot',
        'Femme',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
        'Football/MaillotTest.png;Football/MaillotTest2.png;Football/MaillotTest.png;Football/MaillotTest2.png',
        true,
        '2022-11-21 20:05:37'
     ),
    (
        2,
        'Chaussure',
        2,
        'Puma',
        'Chaussure volley',
        'Mixte',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
         'Volleyball/chaussure.png;Volleyball/chaussure.png;Volleyball/chaussure.png;Volleyball/chaussure.png',
        true,
        '2022-11-21 20:05:37'
         ),
    (
        3,
        'Equipement',
        3,
        'Addidas',
        'Raquette',
        'Homme',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
         'Badminton/raquette.jpg;Badminton/raquette.jpg;Badminton/raquette.jpg;Badminton/raquette.jpg',
        true,
        '2022-11-21 20:05:37'
         ),
    (
        4,
        'Vêtement',
        1,
        'Nike',
        'Maillot foot v2',
        'Homme',
        99.99,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere, nisi tincidunt dictum consectetur, ante ipsum scelerisque magna,
         eu dapibus felis nulla et ex. Donec lobortis nibh massa, sit amet fringilla sapien tristique id. Ut nec velit volutpat. ',
        'Football/MaillotTest2.png;Football/MaillotTest.png;Football/MaillotTest2.png;Football/MaillotTest.png',
        true,
        '2022-11-21 20:05:37'
         );


insert into catalog (id, nuproduct, reference, color, size, quantity, isALive, dateLastUpdate)
values
    (1,1,4064,'Rouge','XS',2, true, '2022-11-21 20:05:37'),
    (2,2,7064,'Bleu','35',1, true, '2022-11-21 20:05:37'),
    (3,3,6064,null,null, 5, true, '2022-11-21 20:05:37'),
    (4,1,5064,'Vert','XS',2, true, '2022-11-21 20:05:37'),
    (5,4,5065,'Bleu','L',1, true, '2022-11-21 20:05:37'),
    (6,1,4065,'Rouge','XXL',0, true, '2022-11-21 20:05:37');

insert into `order` (id, iduser, dateorder, idlocation , state, isALive, dateLastUpdate)
values
    (1,2,'2022-10-10',3,'En preparation', true, '2022-11-21 20:05:37'),
    (2,2,'2022-10-10',3,'En preparation', true, '2022-11-21 20:05:37'),
    (3,2,'2022-10-10',3,'En preparation', true, '2022-11-21 20:05:37');

insert into order_products (idorder, idproduct, idvariant, quantity)
values
    (1,1,1,1),
    (1,2,1,1),
    (2,2,2,1),
    (3,1,4,1);

insert into cart (id,iduser,idcart,idvariant,quantity,date,dateExp)
values
    (1,2,1,1,1,'2022-11-21 20:05:37','2022-11-21 22:10:15'),
    (2,2,2,1,2,'2022-11-21 21:05:37','2022-11-21 22:10:15'),
    (3,2,1,2,1,'2022-11-21 21:05:37','2022-11-21 22:10:15');
