SET sql_mode=ORACLE;

CREATE OR REPLACE PACKAGE sport AS
      procedure getNameSport(IN nusport integer);
      procedure getIdSport(IN name VARCHAR(20));
END;

CREATE OR REPLACE PACKAGE BODY sport AS
  procedure getNameSport(IN nusport integer) as
    begin
        select nom from sport where sport.nusport = nusport;
    end;

  procedure getIdSport(IN name VARCHAR(20)) as
    begin
        select nusport from sport where nom = name;
    end;
END;

CREATE OR REPLACE PACKAGE utilisateur AS
    procedure verifyLogin(IN loginSearch VARCHAR(255));
    procedure verifyEmail(IN mailSearch VARCHAR(255));
    procedure verifyPhone(IN phone int);
    procedure verifyId(in newId int);
    procedure getUserByLogin(IN loginSearch VARCHAR(255));
    procedure getUserById(IN idSearch VARCHAR(255));
    procedure getUserByEmail(IN mailSearch VARCHAR(255));
    procedure getPasswordById(IN idSearch VARCHAR(255));
    procedure getStatusById(IN idSearch VARCHAR(255));
    procedure loginMail(IN mail VARCHAR(255));
    procedure addUser(IN newid integer,IN newlogin varchar(255), IN newpass varchar(255), IN newsalt VARCHAR(45), IN newstatus varchar(20));
    procedure addCoordonnee(IN newid int, IN newprenom varchar(255), IN newnom varchar(255), IN newmail varchar(255), in newmobile int, in newfixe int);
    procedure createUser(in newId integer, in newLogin varchar(255), in newPass varchar(255), in newSalt varchar(45), in newPrenom varchar(255), in newNom varchar(255), in newEmail varchar(255), in newMobile int, in newFixe int);
    procedure addLocalisation(IN newidadresse int, IN newid int, IN newadresse varchar(255), IN newcode int, IN newville varchar(255), IN newdep varchar(255), IN newpays varchar(255));
    procedure delUser(In iduser int);
    procedure setCookieId(IN newCookieId varchar(45), IN iduser int);
    procedure delCookieId(IN iduser int);
    procedure updateCoordonnees(IN iduser int, IN newprenom varchar(255), IN newnom varchar(255), IN newmail varchar(255), in newmobile int, in newfixe int);
    procedure updateLocalisation(IN newidadresse int,IN iduser int, IN newadresse varchar(255), IN newcode int, IN newville varchar(255), IN newdep varchar(255), IN newpays varchar(255));
    procedure updateUtilisateur(in iduser int, in newlogin varchar(255), in newpass varchar(255));
    procedure updateStatus(in iduser int, in newstatus varchar(20));
END;

CREATE OR REPLACE PACKAGE BODY utilisateur AS
    procedure verifyLogin(IN loginSearch VARCHAR(255)) as
    begin
        select login from utilisateur where loginSearch = login;
    end;

    procedure verifyEmail(IN mailSearch VARCHAR(255)) as
    begin
        select login from utilisateur where id in (select id from coordonnees where mailSearch = coordonnees.mail);
    end;

    procedure verifyPhone(IN phone int) as
    begin
        select login from utilisateur where id in (select id from coordonnees where phone = mobile);
    end;

    procedure verifyId(in newId int) as
    begin
        select login from utilisateur where newId = id;
    end;

    procedure getUserByLogin(IN loginSearch VARCHAR(255)) as
    begin
        select login, id from utilisateur where login = loginSearch;
    end;

    procedure getUserById(IN idSearch VARCHAR(255)) as
    begin
        select id, cookieId, status from utilisateur where id = idSearch;
    end;

    procedure getUserByEmail(IN mailSearch VARCHAR(255)) as
    begin
        select login, id from utilisateur where id in (select id from coordonnees where mailSearch = coordonnees.mail);
    end;

    procedure getPasswordById(IN idSearch VARCHAR(255)) as
    begin
        select password, salt from utilisateur where id = idSearch;
    end;

    procedure getStatusById(IN idSearch VARCHAR(255)) as
    begin
        select status from utilisateur where id = idSearch;
    end;

    procedure loginMail(IN mail VARCHAR(255)) as
    begin
        select password from utilisateur where id in (select id from coordonnees where mail = coordonnees.mail);
    end;

    procedure addUser(IN newid integer,IN newlogin varchar(255), IN newpass varchar(255), IN newsalt VARCHAR(45), IN newstatus varchar(20)) as
    BEGIN
        insert into utilisateur(id, login,password,salt,status) value (newid, newlogin,newpass,newsalt, newstatus);
    end;

    procedure addCoordonnee(IN newid int, IN newprenom varchar(255), IN newnom varchar(255), IN newmail varchar(255), in newmobile int, in newfixe int) as
    BEGIN
        insert into coordonnees(id,prenom,nom,mail,mobile,fixe) value (newid,newprenom,newnom,newmail,newmobile,newfixe);
    end;

    procedure createUser(in newId integer, in newLogin varchar(255), in newPass varchar(255), in newSalt varchar(45), in newPrenom varchar(255), in newNom varchar(255), in newEmail varchar(255), in newMobile int, in newFixe int) as
    begin
        insert into utilisateur(id, login, password, salt, status) value (newId, newLogin, newPass, newSalt, 'Client');
        insert into coordonnees(id, prenom, nom, mail, mobile, fixe) value (newId, newPrenom, newNom, newEmail, newMobile, newFixe);
    end;

    procedure addLocalisation(IN newidadresse int, IN newid int, IN newadresse varchar(255), IN newcode int, IN newville varchar(255), IN newdep varchar(255), IN newpays varchar(255)) as
    BEGIN
        insert into localisation(idadresse,id,adresse,codepostal,ville,departement,pays) value (newidadresse,newid,newadresse,newcode,newville,newdep,newpays);
    end;

    procedure delUser(In iduser int) as
    BEGIN
        delete from utilisateur where id = iduser;
        delete from coordonnees where id = iduser;
        delete from localisation where id = iduser;
    end;

    procedure setCookieId(IN newCookieId varchar(45), IN iduser int) as
    BEGIN
        update utilisateur set cookieId=newCookieId where id = iduser;
    end;

    procedure delCookieId(IN iduser int) as
    BEGIN
        update utilisateur set cookieId='' where id = iduser;
    end;

    procedure updateCoordonnees(IN iduser int, IN newprenom varchar(255), IN newnom varchar(255), IN newmail varchar(255), in newmobile int, in newfixe int) as
    BEGIN
        update coordonnees set prenom=newprenom, nom=newnom, mail=newmail, mobile=newmobile, fixe=newfixe where id=iduser;
    end;

    procedure updateLocalisation(IN newidadresse int,IN iduser int, IN newadresse varchar(255), IN newcode int, IN newville varchar(255), IN newdep varchar(255), IN newpays varchar(255)) as
    BEGIN
        update localisation set adresse=newadresse, codepostal=newcode, ville=newville, departement=newdep, pays=newpays where id = iduser and idadresse=newidadresse;
    end;

    procedure updateUtilisateur(in iduser int, in newlogin varchar(255), in newpass varchar(255)) as
    BEGIN
        update utilisateur set login=newlogin, password=newpass where id=iduser;
    end;

    procedure updateStatus(in iduser int, in newstatus varchar(20)) as
    BEGIN
        update utilisateur set status=newstatus where id=iduser;
    end;

END;

CREATE OR REPLACE PACKAGE produit AS
    procedure getProductBySport(IN sport integer);
    procedure getProductByType(IN type varchar(15));
    procedure getProductByBrand(IN brand varchar(255));
    procedure orderByPriceAsc();
    procedure orderByPriceDesc();
    procedure getProductBySize(IN size varchar(3));
    procedure getProductByColor(IN color varchar(20));
    procedure getProductBySportType(IN sport integer, IN type varchar(15));
    procedure getProductById(IN id integer);
    procedure addProduct(IN newid int, IN newreference int, IN newtype varchar(15), IN newnusport int, IN newmarque varchar(255), IN newnom varchar(255),IN newgenre varchar(5), IN newprix float, in newdesc varchar(255), in newimage varchar(255));
    procedure updatePrice(in nuproduit int, in newprice int);
    procedure updateDescription(in nuproduit int, in newdesc varchar(255));
    procedure updateImage(in nuproduit int, in newimage varchar(255));
    procedure delProduct(IN nuproduct int);
END;

CREATE OR REPLACE PACKAGE BODY produit AS
   procedure getProductBySport(IN sport integer) as
    Begin
        select * from produit where nusport = sport;
    END;

    procedure getProductByType(IN type varchar(15)) as
    Begin
        select * from produit where produit.type = type;
    END;

    procedure getProductByBrand(IN brand varchar(255)) as
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

    procedure getProductBySize(IN size varchar(3)) as
    begin
        select * from produit where idproduit in (select distinct nuproduit from catalogue where taille = size);
    end;

    procedure getProductByColor(IN color varchar(20)) as
    begin
        select * from produit where idproduit in (select distinct nuproduit from catalogue where couleur = color);
    end;

    procedure getProductBySportType(IN sport integer, IN type varchar(15)) as
    BEGIN
        select * from produit where nusport = sport and type = produit.type;
    end;

    procedure getProductById(IN id integer) as
    begin
        select * from produit where idproduit = id;
    end;

    procedure addProduct(IN newid int, IN newreference int, IN newtype varchar(15), IN newnusport int, IN newmarque varchar(255), IN newnom varchar(255),IN newgenre varchar(5), IN newprix float, in newdesc varchar(255), in newimage varchar(255)) as
    BEGIN
        insert into produit(idproduit, reference, type, nusport, marque, nom, genre, prix, description, image) value (newid, newreference,newtype,newnusport,newmarque,newnom,newgenre,newprix,newdesc,newimage);
    end;

    procedure delProduct(IN nuproduct int) as
    BEGIN
        delete from produit where idproduit = nuproduct;
        delete from catalogue where nuproduit = nuproduct;
    end;

    procedure updatePrice(in nuproduit int, in newprice int) as
    BEGIN
        update produit set prix=newprice where idproduit=nuproduit;
    end;

    procedure updateDescription(in nuproduit int, in newdesc varchar(255)) as
    BEGIN
        update produit set description=newdesc where idproduit=nuproduit;
    end;

    procedure updateImage(in nuproduit int, in newimage varchar(255)) as
    BEGIN
        update produit set image=newimage where idproduit=nuproduit;
    end;

END;

CREATE OR REPLACE PACKAGE commande AS
    procedure getCommande(in commande int);
    procedure getCommandeClient(in iduser int);
    procedure addCommande(IN newid int, IN newdate varchar(10), IN newproduit int, in newquantite int, in newclient int,in newadresse int, in newetat varchar(15));
    procedure updateEtat(IN nucommande int,in newetat varchar(15));
    procedure updateAdresseCommande(IN nucommande int,in newadresse varchar(15));
END;

CREATE OR REPLACE PACKAGE BODY commande AS
    procedure getCommande(in commande int) as
    Begin
        select * from commande where idcommande = commande;
    end;

    procedure getCommandeClient(in iduser int) as
    Begin
        select * from commande where idclient = iduser;
    end;

    procedure addCommande(IN newid int, IN newdate varchar(10), IN newproduit int, in newquantite int, in newclient int,in newadresse int, in newetat varchar(15)) as
    BEGIN
        insert into commande(idcommande, datecommande, idproduit, quantite, idclient,idadresse , etat) value (newid, newdate,newproduit,newquantite,newclient,newadresse,newetat);
    end;

    procedure updateEtat(IN nucommande int,in newetat varchar(15)) as
    BEGIN
        update commande set etat=newetat where idcommande = nucommande;
    end;

    procedure updateAdresseCommande(IN nucommande int,in newadresse varchar(15)) as
    BEGIN
        update commande set idadresse=newadresse where idcommande = nucommande;
    end;

END;


CREATE OR REPLACE PACKAGE catalogue AS
    procedure getStock(IN id integer);
    procedure getStockTotal(IN id integer);
    procedure addCatalogue(IN newid int, IN newproduit int, in newcouleur varchar(20), in newtaille varchar(3), in newquantite int);
    procedure delVariante(IN idvariante int);
    procedure updateQuantite(IN iduser int, IN newquantite int);
END;

CREATE OR REPLACE PACKAGE BODY catalogue AS
    procedure getStock(IN id integer) as
    begin
        select * from catalogue where nuproduit = id;
    end;

    procedure getStockTotal(IN id integer) as
    begin
        select sum(quantite) from catalogue where nuproduit = id;
    end;

    procedure addCatalogue(IN newid int, IN newproduit int, in newcouleur varchar(20), in newtaille varchar(3), in newquantite int) as
    BEGIN
        insert into catalogue(id, nuproduit, couleur, taille,quantite) value (newid,newproduit,newcouleur,newtaille,newquantite);
    end;

    procedure delVariante(IN idvariante int) as
    begin
        delete from catalogue where id = idvariante;
    end;

    procedure updateQuantite(IN iduser int, IN newquantite int) as
    BEGIN
        update catalogue set quantite=newquantite where id = iduser;
    end;

END;


CREATE OR REPLACE PACKAGE captcha AS
    procedure countWordCapchat(IN newWord varchar(20), In ipAddress varchar(45), In expiration int);
    procedure addCaptchat(in captchaTime int, in ipAddress varchar(45), in newWord varchar(20));
    procedure cleanCaptchat(IN expiration int);
END;

CREATE OR REPLACE PACKAGE BODY captcha AS
    procedure countWordCapchat(IN newWord varchar(20), In ipAddress varchar(45), In expiration int) as
    begin
        select count(*) as count from captcha where word = newWord and ip_address = ipAddress and captcha_time > expiration;
    end;

    procedure addCaptchat(in captchaTime int, in ipAddress varchar(45), in newWord varchar(20)) as
    BEGIN
        insert into captcha(captcha_time, ip_address, word) value (captchaTime, ipAddress, newWord);
    end;

    procedure cleanCaptchat(IN expiration int) as
    begin
        delete from captcha where captcha_time < expiration;
    end;
END;