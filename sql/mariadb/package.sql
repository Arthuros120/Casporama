SET sql_mode=ORACLE;

CREATE OR REPLACE PACKAGE sport AS
      procedure getNameSport( nusport integer);
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

CREATE OR REPLACE PACKAGE utilisateur AS
    procedure verifyLogin( loginSearch VARCHAR(255));
    procedure verifyEmail( mailSearch VARCHAR(255));
    procedure verifyPhone( phone int);
    procedure verifyId( newId int);
    procedure getUserByLogin( loginSearch VARCHAR(255));
    procedure getUserById( idSearch VARCHAR(255));
    procedure getUserByEmail( mailSearch VARCHAR(255));
    procedure getPasswordById( idSearch VARCHAR(255));
    procedure getStatusById( idSearch VARCHAR(255));
    procedure loginMail( mail VARCHAR(255));
    procedure addUser( newid integer, newlogin varchar(255),  newpass varchar(255),  newsalt VARCHAR(45),  newstatus varchar(20));
    procedure addCoordonnee( newid int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int);
    procedure createUser( newId integer,  newLogin varchar(255),  newPass varchar(255),  newSalt varchar(45),  newPrenom varchar(255),  newNom varchar(255),  newEmail varchar(255),  newMobile int,  newFixe int);
    procedure addLocalisation( newidadresse int,  newid int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255));
    procedure delUser( iduser int);
    procedure setCookieId( newCookieId varchar(45),  iduser int);
    procedure delCookieId( iduser int);
    procedure updateCoordonnees( iduser int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int);
    procedure updateLocalisation( newidadresse int, iduser int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255));
    procedure updateUtilisateur( iduser int,  newlogin varchar(255),  newpass varchar(255));
    procedure updateStatus( iduser int,  newstatus varchar(20));
END;

CREATE OR REPLACE PACKAGE BODY utilisateur AS
    procedure verifyLogin( loginSearch VARCHAR(255)) as
    begin
        select login from utilisateur where loginSearch = login;
    end;

    procedure verifyEmail( mailSearch VARCHAR(255)) as
    begin
        select login from utilisateur where id in (select coordonnees.id from coordonnees where mailSearch = coordonnees.mail);
    end;

    procedure verifyPhone( phone int) as
    begin
        select login from utilisateur where id in (select id from coordonnees where phone = mobile);
    end;

    procedure verifyId( newId int) as
    begin
        select login from utilisateur where newId = id;
    end;

    procedure getUserByLogin( loginSearch VARCHAR(255)) as
    begin
        select login, id from utilisateur where login = loginSearch;
    end;

    procedure getUserById( idSearch VARCHAR(255)) as
    begin
        select id, cookieId, status from utilisateur where id = idSearch;
    end;

    procedure getUserByEmail( mailSearch VARCHAR(255)) as
    begin
        select login, id from utilisateur where id in (select id from coordonnees where mailSearch = coordonnees.mail);
    end;

    procedure getPasswordById( idSearch VARCHAR(255)) as
    begin
        select password, salt from utilisateur where id = idSearch;
    end;

    procedure getStatusById( idSearch VARCHAR(255)) as
    begin
        select status from utilisateur where id = idSearch;
    end;

    procedure loginMail( mail VARCHAR(255)) as
    begin
        select password from utilisateur where id in (select id from coordonnees where mail = coordonnees.mail);
    end;

    procedure addUser( newid integer, newlogin varchar(255),  newpass varchar(255),  newsalt VARCHAR(45),  newstatus varchar(20)) as
    BEGIN
        insert into utilisateur(id, login,password,salt,status) value (newid, newlogin,newpass,newsalt, newstatus);
    end;

    procedure addCoordonnee( newid int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int) as
    BEGIN
        insert into coordonnees(id,prenom,nom,mail,mobile,fixe) value (newid,newprenom,newnom,newmail,newmobile,newfixe);
    end;

    procedure createUser( newId integer,  newLogin varchar(255),  newPass varchar(255),  newSalt varchar(45),  newPrenom varchar(255),  newNom varchar(255),  newEmail varchar(255),  newMobile int,  newFixe int) as
    begin
        insert into utilisateur(id, login, password, salt, status) value (newId, newLogin, newPass, newSalt, 'Client');
        insert into coordonnees(id, prenom, nom, mail, mobile, fixe) value (newId, newPrenom, newNom, newEmail, newMobile, newFixe);
    end;

    procedure addLocalisation( newidadresse int,  newid int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255)) as
    BEGIN
        insert into localisation(idadresse,id,adresse,codepostal,ville,departement,pays) value (newidadresse,newid,newadresse,newcode,newville,newdep,newpays);
    end;

    procedure delUser( iduser int) as
    BEGIN
        delete from utilisateur where id = iduser;
        delete from coordonnees where id = iduser;
        delete from localisation where id = iduser;
    end;

    procedure setCookieId( newCookieId varchar(45),  iduser int) as
    BEGIN
        update utilisateur set cookieId=newCookieId where id = iduser;
    end;

    procedure delCookieId( iduser int) as
    BEGIN
        update utilisateur set cookieId='' where id = iduser;
    end;

    procedure updateCoordonnees( iduser int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int) as
    BEGIN
        update coordonnees set prenom=newprenom, nom=newnom, mail=newmail, mobile=newmobile, fixe=newfixe where id=iduser;
    end;

    procedure updateLocalisation( newidadresse int, iduser int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255)) as
    BEGIN
        update localisation set adresse=newadresse, codepostal=newcode, ville=newville, departement=newdep, pays=newpays where id = iduser and idadresse=newidadresse;
    end;

    procedure updateUtilisateur( iduser int,  newlogin varchar(255),  newpass varchar(255)) as
    BEGIN
        update utilisateur set login=newlogin, password=newpass where id=iduser;
    end;

    procedure updateStatus( iduser int,  newstatus varchar(20)) as
    BEGIN
        update utilisateur set status=newstatus where id=iduser;
    end;

END;

CREATE OR REPLACE PACKAGE produit AS
    procedure getProductBySport( sport integer);
    procedure getProductByType( type varchar(15));
    procedure getProductByBrand( brand varchar(255));
    procedure orderByPriceAsc();
    procedure orderByPriceDesc();
    procedure getProductBySize( size varchar(3));
    procedure getProductByColor( color varchar(20));
    procedure getProductBySportType( sport integer,  type varchar(15));
    procedure getProductById( id integer);
    procedure addProduct( newid int,  newreference int,  newtype varchar(15),  newnusport int,  newmarque varchar(255),  newnom varchar(255), newgenre varchar(5),  newprix float,  newdesc varchar(255),  newimage varchar(255));
    procedure updatePrice( nuproduit int,  newprice int);
    procedure updateDescription( nuproduit int,  newdesc varchar(255));
    procedure updateImage( nuproduit int,  newimage varchar(255));
    procedure delProduct( nuproduct int);
END;

CREATE OR REPLACE PACKAGE BODY produit AS
   procedure getProductBySport( sport integer) as
    Begin
        select * from produit where nusport = sport;
    END;

    procedure getProductByType( type varchar(15)) as
    Begin
        select * from produit where produit.type = type;
    END;

    procedure getProductByBrand( brand varchar(255)) as
    BEGIN
        select * from produit where marque = brand;
    end;

    procedure orderByPriceAsc() as
    BEGIN
        select * from produit order by prix ;
    end;

    procedure orderByPriceDesc() as
    BEGIN
        select * from produit order by prix desc ;
    end;

    procedure getProductBySize( size varchar(3)) as
    begin
        select * from produit where idproduit in (select distinct nuproduit from catalogue where taille = size);
    end;

    procedure getProductByColor( color varchar(20)) as
    begin
        select * from produit where idproduit in (select distinct nuproduit from catalogue where couleur = color);
    end;

    procedure getProductBySportType( sport integer,  type varchar(15)) as
    BEGIN
        select * from produit where nusport = sport and type = produit.type;
    end;

    procedure getProductById( id integer) as
    begin
        select * from produit where idproduit = id;
    end;

    procedure addProduct( newid int,  newreference int,  newtype varchar(15),  newnusport int,  newmarque varchar(255),  newnom varchar(255), newgenre varchar(5),  newprix float,  newdesc varchar(255),  newimage varchar(255)) as
    BEGIN
        insert into produit(idproduit, reference, type, nusport, marque, nom, genre, prix, description, image) value (newid, newreference,newtype,newnusport,newmarque,newnom,newgenre,newprix,newdesc,newimage);
    end;

    procedure delProduct( nuproduct int) as
    BEGIN
        delete from produit where idproduit = nuproduct;
        delete from catalogue where nuproduit = nuproduct;
    end;

    procedure updatePrice( nuproduit int,  newprice int) as
    BEGIN
        update produit set prix=newprice where idproduit=nuproduit;
    end;

    procedure updateDescription( nuproduit int,  newdesc varchar(255)) as
    BEGIN
        update produit set description=newdesc where idproduit=nuproduit;
    end;

    procedure updateImage( nuproduit int,  newimage varchar(255)) as
    BEGIN
        update produit set image=newimage where idproduit=nuproduit;
    end;

END;

CREATE OR REPLACE PACKAGE commande AS
    procedure getCommande( commande int);
    procedure getCommandeClient( iduser int);
    procedure addCommande( newid int,  newdate varchar(10),  newproduit int,  newquantite int,  newclient int, newadresse int,  newetat varchar(15));
    procedure updateEtat( nucommande int, newetat varchar(15));
    procedure updateAdresseCommande( nucommande int, newadresse varchar(15));
END;

CREATE OR REPLACE PACKAGE BODY commande AS
    procedure getCommande( commande int) as
    Begin
        select * from commande where idcommande = commande;
    end;

    procedure getCommandeClient( iduser int) as
    Begin
        select * from commande where idclient = iduser;
    end;

    procedure addCommande( newid int,  newdate varchar(10),  newproduit int,  newquantite int,  newclient int, newadresse int,  newetat varchar(15)) as
    BEGIN
        insert into commande(idcommande, datecommande, idproduit, quantite, idclient,idadresse , etat) value (newid, newdate,newproduit,newquantite,newclient,newadresse,newetat);
    end;

    procedure updateEtat( nucommande int, newetat varchar(15)) as
    BEGIN
        update commande set etat=newetat where idcommande = nucommande;
    end;

    procedure updateAdresseCommande( nucommande int, newadresse varchar(15)) as
    BEGIN
        update commande set idadresse=newadresse where idcommande = nucommande;
    end;

END;


CREATE OR REPLACE PACKAGE catalogue AS
    procedure getStock( id integer);
    procedure getStockTotal( id integer);
    procedure addCatalogue( newid int,  newproduit int,  newcouleur varchar(20),  newtaille varchar(3),  newquantite int);
    procedure delVariante( idvariante int);
    procedure updateQuantite( iduser int,  newquantite int);
END;

CREATE OR REPLACE PACKAGE BODY catalogue AS
    procedure getStock( id integer) as
    begin
        select * from catalogue where nuproduit = id;
    end;

    procedure getStockTotal( id integer) as
    begin
        select sum(quantite) from catalogue where nuproduit = id;
    end;

    procedure addCatalogue( newid int,  newproduit int,  newcouleur varchar(20),  newtaille varchar(3),  newquantite int) as
    BEGIN
        insert into catalogue(id, nuproduit, couleur, taille,quantite) value (newid,newproduit,newcouleur,newtaille,newquantite);
    end;

    procedure delVariante( idvariante int) as
    begin
        delete from catalogue where id = idvariante;
    end;

    procedure updateQuantite( iduser int,  newquantite int) as
    BEGIN
        update catalogue set quantite=newquantite where id = iduser;
    end;

END;


CREATE OR REPLACE PACKAGE captcha AS
    procedure countWordCapchat( newWord varchar(20),  ipAddress varchar(45),  expiration int);
    procedure addCaptchat( captchaTime int,  ipAddress varchar(45),  newWord varchar(20));
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

--call commande.getCommandeClient(6);