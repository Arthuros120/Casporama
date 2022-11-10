use Casporama;

#---------- Select ----------------

create procedure getProductBySport( sport integer) as
    Begin
        select * from product where nusport = sport;
    END;

create procedure getProductByType( type varchar(15)) as
    Begin
        select * from product where product.type = type;
    END;

create procedure getProductByBrand( brand varchar(255)) as
    BEGIN
        select * from product where marque = brand;
    end;

create procedure orderByPriceAsc() as
    BEGIN
        select * from product order by prix ;
    end;

create procedure orderByPriceDesc() as
    BEGIN
        select * from product order by prix desc ;
    end;

create procedure getNameSport( nusport integer) as
    begin
        select nom from sport where sport.nusport = nusport;
    end;

create procedure getIdSport( name VARCHAR(20)) as
    begin
        select nusport from sport where nom = name;
    end;


create procedure getProductBySize( size varchar(3)) as
    begin
        select * from product where idproduit in (select distinct nuproduit from catalog where taille = size);
    end;

create procedure getProductByColor( color varchar(20)) as
    begin
        select * from product where idproduit in (select distinct nuproduit from catalog where couleur = color);
    end;

create procedure getProductBySportType( sport integer,  type varchar(15)) as
    BEGIN
        select * from product where nusport = sport and type = product.type;
    end;

create procedure verifyLogin( loginSearch VARCHAR(255)) as
    begin
        select login from user where loginSearch = login;
    end;

-- verify que email existe dans la base de données
create procedure verifyEmail( mailSearch VARCHAR(255)) as
    begin
        select login from user where id in (select id from information where mailSearch = information.mail);
    end;

-- verify que mobile existe dans la base de données
create procedure verifyPhone( phone int) as
    begin
        select login from user where id in (select id from information where phone = mobile);
    end;

create procedure verifyId( newId int) as
    begin
        select login from user where newId = id;
    end;

create procedure getUserByLogin( loginSearch VARCHAR(255)) as
    begin
        select login, id from user where login = loginSearch;
    end;

-- on retourne l'user en fonction de son id
create procedure getUserById( idSearch VARCHAR(255)) as
    begin
        select id, cookieId, status from user where id = idSearch;
    end;

-- récupère l'id et l'email de l'user à partir de son email
create procedure getUserByEmail( mailSearch VARCHAR(255)) as
    begin
        select login, id from user where id in (select id from information where mailSearch = information.mail);
    end;

create procedure getPasswordById( idSearch VARCHAR(255)) as
    begin
        select password, salt from user where id = idSearch;
    end;

create procedure getStatusById( idSearch VARCHAR(255)) as
    begin
        select status from user where id = idSearch;
    end;

create procedure loginMail( mail VARCHAR(255)) as
    begin
        select password from user where id in (select id from information where mail = information.mail);
    end;

create procedure getProductById( id integer) as
    begin
        select * from product where idproduit = id;
    end;

create procedure getStock( id integer) as
    begin
        select * from catalog where nuproduit = id;
    end;

create procedure getStockTotal( id integer) as
    begin
        select sum(quantite) from catalog where nuproduit = id;
    end;

create procedure countWordCapchat( newWord varchar(20),  ipAddress varchar(45),  expiration int) as
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


create procedure addUser( newid integer, newlogin varchar(255),  newpass varchar(255),  newsalt VARCHAR(45),  newstatus varchar(20)) as
    BEGIN
        insert into user(id, login,password,salt,status) value (newid, newlogin,newpass,newsalt, newstatus);
    end;

create procedure addCoordonnee( newid int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int) as
    BEGIN
        insert into information(id,prenom,nom,mail,mobile,fixe) value (newid,newprenom,newnom,newmail,newmobile,newfixe);
    end;

create procedure createUser( newId integer,  newLogin varchar(255),  newPass varchar(255),  newSalt varchar(45),  newPrenom varchar(255),  newNom varchar(255),  newEmail varchar(255),  newMobile int,  newFixe int) as
    begin
        insert into user(id, login, password, salt, status) value (newId, newLogin, newPass, newSalt, 'Client');
        insert into information(id, prenom, nom, mail, mobile, fixe) value (newId, newPrenom, newNom, newEmail, newMobile, newFixe);
    end;

create procedure addLocalisation( newidadresse int,  newid int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255)) as
    BEGIN
        insert into location(idadresse,id,adresse,codepostal,ville,departement,pays) value (newidadresse,newid,newadresse,newcode,newville,newdep,newpays);
    end;

create procedure addProduct( newid int,  newreference int,  newtype varchar(15),  newnusport int,  newmarque varchar(255),  newnom varchar(255), newgenre varchar(5),  newprix float,  newdesc varchar(255),  newimage varchar(255)) as
    BEGIN
        insert into product(idproduit, reference, type, nusport, marque, nom, genre, prix, description, image) value (newid, newreference,newtype,newnusport,newmarque,newnom,newgenre,newprix,newdesc,newimage);
    end;

create procedure addCommande( newid int,  newdate varchar(10),  newproduit int,  newquantite int,  newclient int, newadresse int,  newetat varchar(15)) as
    BEGIN
        insert into `order`(idcommande, datecommande, idproduit, quantite, idclient,idadresse , etat) value (newid, newdate,newproduit,newquantite,newclient,newadresse,newetat);
    end;

create procedure addCatalogue( newid int,  newproduit int,  newcouleur varchar(20),  newtaille varchar(3),  newquantite int) as
    BEGIN
        insert into catalog(id, nuproduit, couleur, taille,quantite) value (newid,newproduit,newcouleur,newtaille,newquantite);
    end;

create  procedure addCaptchat( captchaTime int,  ipAddress varchar(45),  newWord varchar(20)) as
    BEGIN

        insert into captcha(captcha_time, ip_address, word) value (captchaTime, ipAddress, newWord);

    end;

-- Call addCaptchat(123, '::1', 'azerty');

#---------- Suppression ----------------

create procedure delUser( iduser int) as
    BEGIN
        delete from user where id = iduser;
        delete from information where id = iduser;
        delete from location where id = iduser;
    end;

create procedure delProduct( nuproduct int) as
    BEGIN
        delete from product where idproduit = nuproduct;
        delete from catalog where nuproduit = nuproduct;
    end;

create procedure delVariante( idvariante int) as
    begin
        delete from catalog where id = idvariante;
    end;

create procedure cleanCaptchat( expiration int) as
    begin

        delete from captcha where captcha_time < expiration;

    end;

#---------- Update ----------------


create procedure updateQuantite( iduser int,  newquantite int) as
    BEGIN
        update catalog set quantite=newquantite where id = iduser;
    end;

-- Ajout du CookieId
create procedure setCookieId( newCookieId varchar(45),  iduser int) as
    BEGIN
        update user set cookieId=newCookieId where id = iduser;
    end;

-- Suppression du cookieId
create procedure delCookieId( iduser int) as
    BEGIN
        update user set cookieId='' where id = iduser;
    end;

create procedure updateEtat( nucommande int, newetat varchar(15)) as
    BEGIN
        update `order` set etat=newetat where idcommande = nucommande;
    end;

create procedure updateAdresseCommande( nucommande int, newadresse varchar(15)) as
    BEGIN
        update `order` set idadresse=newadresse where idcommande = nucommande;
    end;

create procedure updateCoordonnees( iduser int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int) as
    BEGIN
        update information set prenom=newprenom, nom=newnom, mail=newmail, mobile=newmobile, fixe=newfixe where id=iduser;
    end;

create procedure updateLocalisation( newidadresse int, iduser int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255)) as
    BEGIN
        update location set adresse=newadresse, codepostal=newcode, ville=newville, departement=newdep, pays=newpays where id = iduser and idadresse=newidadresse;
    end;

create procedure updatePrice( nuproduit int,  newprice int) as
    BEGIN
        update product set prix=newprice where idproduit=nuproduit;
    end;

create procedure updateDescription( nuproduit int,  newdesc varchar(255)) as
    BEGIN
        update product set description=newdesc where idproduit=nuproduit;
    end;

create procedure updateImage( nuproduit int,  newimage varchar(255)) as
    BEGIN
        update product set image=newimage where idproduit=nuproduit;
    end;

create procedure updateUtilisateur( iduser int,  newlogin varchar(255),  newpass varchar(255)) as
    BEGIN
        update user set login=newlogin, password=newpass where id=iduser;
    end;

create procedure updateStatus( iduser int,  newstatus varchar(20)) as
    BEGIN
        update user set status=newstatus where id=iduser;
    end;