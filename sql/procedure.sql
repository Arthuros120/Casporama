use Casporama;

#---------- Select ----------------

create procedure getProductBySport(IN sport integer)
    Begin
        select * from produit where nusport = sport;
    END;

create procedure getProductByType(IN type varchar(15))
    Begin
        select * from produit where produit.type = type;
    END;

create procedure getProductByBrand(IN brand varchar(255))
    BEGIN
        select * from produit where marque = brand;
    end;

create procedure orderByPriceAsc()
    BEGIN
        select * from produit order by prix ;
    end;

create procedure orderByPriceDesc()
    BEGIN
        select * from produit order by prix desc ;
    end;

create procedure getNameSport(IN nusport integer)
    begin
        select nom from sport where sport.nusport = nusport;
    end;

create procedure getIdSport(IN name VARCHAR(20))
    begin
        select nusport from sport where nom = name;
    end;


create procedure getProductBySize(IN size varchar(3))
    begin
        select * from produit where idproduit in (select distinct nuproduit from catalogue where taille = size);
    end;

create procedure getProductByColor(IN color varchar(20))
    begin
        select * from produit where idproduit in (select distinct nuproduit from catalogue where couleur = color);
    end;

create procedure getProductBySportType(IN sport integer, IN type varchar(15))
    BEGIN
        select * from produit where nusport = sport and type = produit.type;
    end;

create procedure verifyLogin(IN loginSearch VARCHAR(255))
    begin
        select login from utilisateur where loginSearch = login;
    end;

-- verify que email existe dans la base de données
create procedure verifyEmail(IN mailSearch VARCHAR(255))
    begin
        select login from utilisateur where id in (select id from coordonnees where mailSearch = coordonnees.mail);
    end;

create procedure getUserByLogin(IN loginSearch VARCHAR(255))
    begin
        select login, id from utilisateur where login = loginSearch;
    end;

-- on retourne l'utilisateur en fonction de son id
create procedure getUserById(IN idSearch VARCHAR(255))
    begin
        select id, cookieId, status from utilisateur where id = idSearch;
    end;

-- récupère l'id et l'email de l'utilisateur à partir de son email
create procedure getUserByEmail(IN mailSearch VARCHAR(255))
    begin
        select login, id from utilisateur where id in (select id from coordonnees where mailSearch = coordonnees.mail);
    end;

create procedure getPasswordById(IN idSearch VARCHAR(255))
    begin
        select password, salt from utilisateur where id = idSearch;
    end;

create procedure getStatusById(IN idSearch VARCHAR(255))
    begin
        select status from utilisateur where id = idSearch;
    end;

create procedure loginMail(IN mail VARCHAR(255))
    begin
        select password from utilisateur where id in (select id from coordonnees where mail = coordonnees.mail);
    end;

create procedure getProductById(IN id integer)
    begin
        select * from produit where idproduit = id;
    end;

create procedure getStock(IN id integer)
    begin
        select * from catalogue where nuproduit = id;
    end;

create procedure getStockTotal(IN id integer)
    begin
        select sum(quantite) from catalogue where nuproduit = id;
    end;

create procedure countWordCapchat(IN newWord varchar(20), In ipAddress varchar(45), In expiration int)
    begin

        select count(*) as count from captcha where word = newWord and ip_address = ipAddress and captcha_time > expiration;

    end;

/*
call getIdSport('Football');
call getNameSport(2);
call getProductById(1);
call getProductByBrand('Nike');
call getProductByColor('Bleu');
call getProductBySize('XS');
call getProductBySport(2);
call getProductBySportType(1,'Vetement');
call getProductByType('Equipement');
call loginMail('duponse@test.com');
call loginUsername('michelle');
call orderByPriceDesc();
call orderByPriceAsc();
call getStock(1);
call getStockTotal(1);
*/

#---------- Ajout ----------------


create procedure addUser(IN newid integer,IN newlogin varchar(255), IN newpass varchar(255), IN newsalt VARCHAR(45), IN newstatus varchar(20))
    BEGIN
        insert into utilisateur(id, login,password,salt,status) value (newid, newlogin,newpass,newsalt, newstatus);
    end;

create procedure addCoordonnee(IN newid int, IN newprenom varchar(255), IN newnom varchar(255), IN newmail varchar(255), in newmobile int, in newfixe int)
    BEGIN
        insert into coordonnees(id,prenom,nom,mail,mobile,fixe) value (newid,newprenom,newnom,newmail,newmobile,newfixe);
    end;

create procedure addLocalisation(IN newidadresse int, IN newid int, IN newadresse varchar(255), IN newcode int, IN newville varchar(255), IN newdep varchar(255), IN newpays varchar(255))
    BEGIN
        insert into localisation(idadresse,id,adresse,codepostal,ville,departement,pays) value (newidadresse,newid,newadresse,newcode,newville,newdep,newpays);
    end;

create procedure addProduct(IN newid int, IN newreference int, IN newtype varchar(15), IN newnusport int, IN newmarque varchar(255), IN newnom varchar(255),IN newgenre varchar(5), IN newprix float, in newdesc varchar(255), in newimage varchar(255))
    BEGIN
        insert into produit(idproduit, reference, type, nusport, marque, nom, genre, prix, description, image) value (newid, newreference,newtype,newnusport,newmarque,newnom,newgenre,newprix,newdesc,newimage);
    end;

create procedure addCommande(IN newid int, IN newdate varchar(10), IN newproduit int, in newquantite int, in newclient int,in newadresse int, in newetat varchar(15))
    BEGIN
        insert into commande(idcommande, datecommande, idproduit, quantite, idclient,idadresse , etat) value (newid, newdate,newproduit,newquantite,newclient,newadresse,newetat);
    end;

create procedure addCatalogue(IN newid int, IN newproduit int, in newcouleur varchar(20), in newtaille varchar(3), in newquantite int)
    BEGIN
        insert into catalogue(id, nuproduit, couleur, taille,quantite) value (newid,newproduit,newcouleur,newtaille,newquantite);
    end;

create  procedure addCaptchat(in captchaTime int, in ipAddress varchar(45), in newWord varchar(20))
    BEGIN

        insert into captcha(captcha_time, ip_address, word) value (captchaTime, ipAddress, newWord);

    end;

-- Call addCaptchat(123, '::1', 'azerty');

#---------- Suppression ----------------

create procedure delUser(In iduser int)
    BEGIN
        delete from utilisateur where id = iduser;
        delete from coordonnees where id = iduser;
        delete from localisation where id = iduser;
    end;

create procedure delProduct(IN nuproduct int)
    BEGIN
        delete from produit where idproduit = nuproduct;
        delete from catalogue where nuproduit = nuproduct;
    end;

create procedure delVariante(IN idvariante int)
    begin
        delete from catalogue where id = idvariante;
    end;

create procedure cleanCaptchat(IN expiration int)
    begin

        delete from captcha where captcha_time < expiration;

    end;

#---------- Update ----------------


create procedure updateQuantite(IN iduser int, IN newquantite int)
    BEGIN
        update catalogue set quantite=newquantite where id = iduser;
    end;

-- Ajout du CookieId
create procedure setCookieId(IN newCookieId varchar(45), IN iduser int)
    BEGIN
        update utilisateur set cookieId=newCookieId where id = iduser;
    end;

-- Suppression du cookieId
create procedure delCookieId(IN iduser int)
    BEGIN
        update utilisateur set cookieId='' where id = iduser;
    end;

create procedure updateEtat(IN nucommande int,in newetat varchar(15))
    BEGIN
        update commande set etat=newetat where idcommande = nucommande;
    end;

create procedure updateAdresseCommande(IN nucommande int,in newadresse varchar(15))
    BEGIN
        update commande set idadresse=newadresse where idcommande = nucommande;
    end;

create procedure updateCoordonnees(IN iduser int, IN newprenom varchar(255), IN newnom varchar(255), IN newmail varchar(255), in newmobile int, in newfixe int)
    BEGIN
        update coordonnees set prenom=newprenom, nom=newnom, mail=newmail, mobile=newmobile, fixe=newfixe where id=iduser;
    end;

create procedure updateLocalisation(IN newidadresse int,IN iduser int, IN newadresse varchar(255), IN newcode int, IN newville varchar(255), IN newdep varchar(255), IN newpays varchar(255))
    BEGIN
        update localisation set adresse=newadresse, codepostal=newcode, ville=newville, departement=newdep, pays=newpays where id = iduser and idadresse=newidadresse;
    end;

create procedure updatePrice(in nuproduit int, in newprice int)
    BEGIN
        update produit set prix=newprice where idproduit=nuproduit;
    end;

create procedure updateDescription(in nuproduit int, in newdesc varchar(255))
    BEGIN
        update produit set description=newdesc where idproduit=nuproduit;
    end;

create procedure updateImage(in nuproduit int, in newimage varchar(255))
    BEGIN
        update produit set image=newimage where idproduit=nuproduit;
    end;

create procedure updateUtilisateur(in iduser int, in newlogin varchar(255), in newpass varchar(255))
    BEGIN
        update utilisateur set login=newlogin, password=newpass where id=iduser;
    end;

create procedure updateStatus(in iduser int, in newstatus varchar(20))
    BEGIN
        update utilisateur set status=newstatus where id=iduser;
    end;