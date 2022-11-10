SET sql_mode=ORACLE;

-- Les packages sont construit en fonction des différentes tables présentes dans la base de donnée

CREATE OR REPLACE PACKAGE sport AS
    -- Permet d'avoir le nom du sport en fonction de son id
    procedure getNameSport( nusport integer);
    -- Permet d'avoir l'id du sport en fonction de son nom
    procedure getIdSport( name VARCHAR(20));
END;

CREATE OR REPLACE PACKAGE BODY sport AS
  procedure getNameSport( nusport integer) as
    begin
        select nom from sport where sport.nusport = nusport;
    end;

  procedure getIdSport( name VARCHAR(20)) as
    begin
        select nusport from sport where nom = name;
    end;
END;

CREATE OR REPLACE PACKAGE user AS
    -- Permet de vérifier si un login donnée est présent dans la BD
    procedure verifyLogin( loginSearch VARCHAR(255));
    -- Permet de vérifier si un mail donnée est présent dans la BD
    procedure verifyEmail( mailSearch VARCHAR(255));
    -- Permet de vérifier si un Numéro de téléphone donnée est présent dans la BD
    procedure verifyPhone( phone int);
    -- Permet de vérifier si un ID donnée est présent dans la BD
    procedure verifyId( newId int);
    -- Permet de récupérer un user par son login
    procedure getUserByLogin( loginSearch VARCHAR(255));
    -- Permet de récupérer un user par son ID
    procedure getUserById( idSearch VARCHAR(255));
    -- Permet de récupérer un user par son adresse mail
    procedure getUserByEmail( mailSearch VARCHAR(255));
    -- Permet de récupérer un mot de passe par un ID
    procedure getPasswordById( idSearch VARCHAR(255));
    -- Permet de récupérer un status par un ID
    procedure getStatusById( idSearch VARCHAR(255));
    -- Permet de récupérer un mot de passe par une adresse mail
    procedure loginMail( mail VARCHAR(255));
    -- Permet d'ajouter un user
    procedure addUser( newid integer, newlogin varchar(255),  newpass varchar(255),  newsalt VARCHAR(45),  newstatus varchar(20));
    -- Permet d'ajouter les coordonnées d'un user par son ID
    procedure addCoordonnee( newid int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int);
    -- Permet d'ajouter un user et ses coordonnées
    procedure createUser( newId integer,  newLogin varchar(255),  newPass varchar(255),  newSalt varchar(45),  newPrenom varchar(255),  newNom varchar(255),  newEmail varchar(255),  newMobile int,  newFixe int);
    -- Permet d'ajouter une location à un user
    procedure addLocalisation( newidadresse int,  newid int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255));
    -- Permet de supprimer un user, ses coordonnées et sa location
    procedure delUser( iduser int);
    -- Permet d'ajouter un cookie à un user
    procedure setCookieId( newCookieId varchar(45),  iduser int);
    -- Permet de supprimer le cookie d'un user
    procedure delCookieId( iduser int);
    -- Permet de mettre à jour les différentes coordonnées d'un user
    procedure updateCoordonnees( iduser int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int);
    -- Permet de mettre à jour les différentes localisations d'un user
    procedure updateLocalisation( newidadresse int, iduser int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255));
    -- Permet de mettre à jour un user
    procedure updateUtilisateur( iduser int,  newlogin varchar(255),  newpass varchar(255));
    -- Permet de mettre à jour le status d'un user
    procedure updateStatus( iduser int,  newstatus varchar(20));
END;

CREATE OR REPLACE PACKAGE BODY user AS
    procedure verifyLogin( loginSearch VARCHAR(255)) as
    begin
        select login from user where loginSearch = login;
    end;

    procedure verifyEmail( mailSearch VARCHAR(255)) as
    begin
        select login from user where id in (select information.id from information where mailSearch = information.mail);
    end;

    procedure verifyPhone( phone int) as
    begin
        select login from user where id in (select id from information where phone = mobile);
    end;

    procedure verifyId( newId int) as
    begin
        select login from user where newId = id;
    end;

    procedure getUserByLogin( loginSearch VARCHAR(255)) as
    begin
        select login, id from user where login = loginSearch;
    end;

    procedure getUserById( idSearch VARCHAR(255)) as
    begin
        select id, cookieId, status from user where id = idSearch;
    end;

    procedure getUserByEmail( mailSearch VARCHAR(255)) as
    begin
        select login, id from user where id in (select id from information where mailSearch = information.mail);
    end;

    procedure getPasswordById( idSearch VARCHAR(255)) as
    begin
        select password, salt from user where id = idSearch;
    end;

    procedure getStatusById( idSearch VARCHAR(255)) as
    begin
        select status from user where id = idSearch;
    end;

    procedure loginMail( mail VARCHAR(255)) as
    begin
        select password from user where id in (select id from information where mail = information.mail);
    end;

    procedure addUser( newid integer, newlogin varchar(255),  newpass varchar(255),  newsalt VARCHAR(45),  newstatus varchar(20)) as
    BEGIN
        insert into user(id, login,password,salt,status) value (newid, newlogin,newpass,newsalt, newstatus);
    end;

    procedure addCoordonnee( newid int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int) as
    BEGIN
        insert into information(id,prenom,nom,mail,mobile,fixe) value (newid,newprenom,newnom,newmail,newmobile,newfixe);
    end;

    procedure createUser( newId integer,  newLogin varchar(255),  newPass varchar(255),  newSalt varchar(45),  newPrenom varchar(255),  newNom varchar(255),  newEmail varchar(255),  newMobile int,  newFixe int) as
    begin
        insert into user(id, login, password, salt, status) value (newId, newLogin, newPass, newSalt, 'Client');
        insert into information(id, prenom, nom, mail, mobile, fixe) value (newId, newPrenom, newNom, newEmail, newMobile, newFixe);
    end;

    procedure addLocalisation( newidadresse int,  newid int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255)) as
    BEGIN
        insert into location(idadresse,id,adresse,codepostal,ville,departement,pays) value (newidadresse,newid,newadresse,newcode,newville,newdep,newpays);
    end;

    procedure delUser( iduser int) as
    BEGIN
        delete from user where id = iduser;
        delete from information where id = iduser;
        delete from location where id = iduser;
    end;

    procedure setCookieId( newCookieId varchar(45),  iduser int) as
    BEGIN
        update user set cookieId=newCookieId where id = iduser;
    end;

    procedure delCookieId( iduser int) as
    BEGIN
        update user set cookieId=null where id = iduser;
    end;

    procedure updateCoordonnees( iduser int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int) as
    BEGIN
        update information set prenom=newprenom, nom=newnom, mail=newmail, mobile=newmobile, fixe=newfixe where id=iduser;
    end;

    procedure updateLocalisation( newidadresse int, iduser int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255)) as
    BEGIN
        update location set adresse=newadresse, codepostal=newcode, ville=newville, departement=newdep, pays=newpays where id = iduser and idadresse=newidadresse;
    end;

    procedure updateUtilisateur( iduser int,  newlogin varchar(255),  newpass varchar(255)) as
    BEGIN
        update user set login=newlogin, password=newpass where id=iduser;
    end;

    procedure updateStatus( iduser int,  newstatus varchar(20)) as
    BEGIN
        update user set status=newstatus where id=iduser;
    end;

END;

CREATE OR REPLACE PACKAGE product AS
    -- Permet d'avoir les différents produits d'un sport spécifique
    procedure getProductBySport( sport integer);
    -- Permet d'avoir les différents produits d'un type spécifique
    procedure getProductByType( type varchar(15));
    -- Permet d'avoir les différents produits d'une marque spécifique
    procedure getProductByBrand( brand varchar(255));
    -- Permet d'avoir les différents produits trié par prix croissant
    procedure orderByPriceAsc();
    -- Permet d'avoir les différents produits trié par prix décroissant
    procedure orderByPriceDesc();
    -- Permet d'avoir les différents produits d'une taille spécifique
    procedure getProductBySize( size varchar(3));
    -- Permet d'avoir les différents produits d'une couleur spécifique
    procedure getProductByColor( color varchar(20));
    -- Permet d'avoir les différents produits d'un sport et d'un type spécifique
    procedure getProductBySportType( sport integer,  type varchar(15));
    -- Permet d'avoir un product par son ID
    procedure getProductById( id integer);
    -- Permet d'ajouter un product à la BD
    procedure addProduct( newid int,  newreference int,  newtype varchar(15),  newnusport int,  newmarque varchar(255),  newnom varchar(255), newgenre varchar(5),  newprix float,  newdesc varchar(255),  newimage varchar(255));
    -- Permet de mettre à jour le prix d'un product
    procedure updatePrice( nuproduit int,  newprice int);
    -- Permet de mettre à jour la description d'un product
    procedure updateDescription( nuproduit int,  newdesc varchar(255));
    -- Permet de mettre à jour le chemin vers l'image d'un product
    procedure updateImage( nuproduit int,  newimage varchar(255));
    -- Permet de supprimer un product
    procedure delProduct( nuproduct int);
END;

CREATE OR REPLACE PACKAGE BODY product AS
   procedure getProductBySport( sport integer) as
    Begin
        select * from product where nusport = sport;
    END;

    procedure getProductByType( type varchar(15)) as
    Begin
        select * from product where product.type = type;
    END;

    procedure getProductByBrand( brand varchar(255)) as
    BEGIN
        select * from product where marque = brand;
    end;

    procedure orderByPriceAsc() as
    BEGIN
        select * from product order by prix ;
    end;

    procedure orderByPriceDesc() as
    BEGIN
        select * from product order by prix desc ;
    end;

    procedure getProductBySize( size varchar(3)) as
    begin
        select * from product where idproduit in (select distinct nuproduit from catalog where taille = size);
    end;

    procedure getProductByColor( color varchar(20)) as
    begin
        select * from product where idproduit in (select distinct nuproduit from catalog where couleur = color);
    end;

    procedure getProductBySportType( sport integer,  type varchar(15)) as
    BEGIN
        select * from product where nusport = sport and type = product.type;
    end;

    procedure getProductById( id integer) as
    begin
        SET sql_mode=ORACLE;
        select * from product where idproduit = id;
    end;

    procedure addProduct( newid int,  newreference int,  newtype varchar(15),  newnusport int,  newmarque varchar(255),  newnom varchar(255), newgenre varchar(5),  newprix float,  newdesc varchar(255),  newimage varchar(255)) as
    BEGIN
        insert into product(idproduit, reference, type, nusport, marque, nom, genre, prix, description, image) value (newid, newreference,newtype,newnusport,newmarque,newnom,newgenre,newprix,newdesc,newimage);
    end;

    procedure delProduct( nuproduct int) as
    BEGIN
        delete from product where idproduit = nuproduct;
        delete from catalog where nuproduit = nuproduct;
    end;

    procedure updatePrice( nuproduit int,  newprice int) as
    BEGIN
        update product set prix=newprice where idproduit=nuproduit;
    end;

    procedure updateDescription( nuproduit int,  newdesc varchar(255)) as
    BEGIN
        update product set description=newdesc where idproduit=nuproduit;
    end;

    procedure updateImage( nuproduit int,  newimage varchar(255)) as
    BEGIN
        update product set image=newimage where idproduit=nuproduit;
    end;

END;

CREATE OR REPLACE PACKAGE `order` AS
    -- Permet d'avoir une commande par son ID
    procedure getCommande( commande int);
    -- Permet d'avoir les commandes d'un client
    procedure getCommandeClient( iduser int);
    -- Permet d'ajouter une commande à un client
    procedure addCommande( newid int,  newdate varchar(10),  newproduit varchar(255),  newquantite int,  newclient int, newadresse int,  newetat varchar(15));
    -- Permet de mettre à jour l'état d'une commande
    procedure updateEtat( nucommande int, newetat varchar(15));
    -- Permet de mettre à jour l'adresse d'une commande
    procedure updateAdresseCommande( nucommande int, newadresse varchar(15));
END;

CREATE OR REPLACE PACKAGE BODY `order` AS
    procedure getCommande( commande int) as
    Begin
        select * from `order` where idcommande = commande;
    end;

    procedure getCommandeClient( iduser int) as
    Begin
        select * from `order` where idclient = iduser;
    end;

    procedure addCommande( newid int,  newdate varchar(10),  newproduit varchar(255),  newquantite int,  newclient int, newadresse int,  newetat varchar(15)) as
    BEGIN
        insert into `order`(idcommande, datecommande, idproduit, quantite, idclient,idadresse , etat) value (newid, newdate,newproduit,newquantite,newclient,newadresse,newetat);
    end;

    procedure updateEtat( nucommande int, newetat varchar(15)) as
    BEGIN
        update `order` set etat=newetat where idcommande = nucommande;
    end;

    procedure updateAdresseCommande( nucommande int, newadresse varchar(15)) as
    BEGIN
        update `order` set idadresse=newadresse where idcommande = nucommande;
    end;

END;


CREATE OR REPLACE PACKAGE catalog AS
    -- Permet d'avoir le stock d'un product par son ID, donc toute les variantes existantes
    procedure getStock( id integer);
    -- Permet d'avoir le nombre total en stock d'un product
    procedure getStockTotal( id integer);
    -- Permet d'ajouter au Catalogue un nouveau product ou variante d'un product, la variante étant par exemple un même t-shirt mais de différente couleur ou taille
    procedure addCatalogue( newid int,  newproduit int,  newcouleur varchar(20),  newtaille varchar(3),  newquantite int);
    -- Permet de supprimer une variante
    procedure delVariante( idvariante int);
    -- Permet de mettre à jour la quantité d'une variante donnée
    procedure updateQuantite( idvariante int,  newquantite int);
END;

CREATE OR REPLACE PACKAGE BODY catalog AS
    procedure getStock( id integer) as
    begin
        select * from catalog where nuproduit = id;
    end;

    procedure getStockTotal( id integer) as
    begin
        select sum(quantite) from catalog where nuproduit = id;
    end;

    procedure addCatalogue( newid int,  newproduit int,  newcouleur varchar(20),  newtaille varchar(3),  newquantite int) as
    BEGIN
        insert into catalog(id, nuproduit, couleur, taille,quantite) value (newid,newproduit,newcouleur,newtaille,newquantite);
    end;

    procedure delVariante( idvariante int) as
    begin
        delete from catalog where id = idvariante;
    end;

    procedure updateQuantite( idvariante int,  newquantite int) as
    BEGIN
        update catalog set quantite=newquantite where id = idvariante;
    end;

END;


CREATE OR REPLACE PACKAGE captcha AS
    -- Permet d'avoir le nombre de Captcha actif pour une adresse donnée
    procedure countWordCapchat( newWord varchar(20),  ipAddress varchar(45),  expiration int);
    -- Permet d'ajouter un Captchat à la BD
    procedure addCaptchat( captchaTime int,  ipAddress varchar(45),  newWord varchar(20));
    -- Permet de supprimer un Captcha en fonction de sa durée de vie
    procedure cleanCaptchat( expiration int);
END;

CREATE OR REPLACE PACKAGE BODY captcha AS
    procedure countWordCapchat( newWord varchar(20),  ipAddress varchar(45),  expiration int) as
    begin
        select count(*) as count from captcha where word = newWord and ip_address = ipAddress and captcha_time > expiration;
    end;

    procedure addCaptchat( captchaTime int,  ipAddress varchar(45),  newWord varchar(20)) as
    BEGIN
        insert into captcha(captcha_time, ip_address, word) value (captchaTime, ipAddress, newWord);
    end;

    procedure cleanCaptchat( expiration int) as
    begin
        delete from captcha where captcha_time < expiration;
    end;
END;

call `order`.getCommandeClient(6);