use Casporama;

-- Select ----------------

create procedure getUserInfoById(iduser integer)
    Begin
        select * from information where id = iduser;
    END;

create procedure getUserLocationById(iduser int)
    Begin
        select * from location where id = iduser;
    END;


create procedure getProductBySport( sport integer)
    Begin
        select * from product where nusport = sport;
    END;

create procedure getProductByType( type varchar(15))
    Begin
        select * from product where product.type = type;
    END;

create procedure getProductByBrand( brand varchar(255))
    BEGIN
        select * from product where product.brand = brand;
    end;

create procedure orderByPriceAsc()
    BEGIN
        select * from product order by price ;
    end;

create procedure orderByPriceDesc()
    BEGIN
        select * from product order by price desc ;
    end;

create procedure getNameSport( nusport integer)
    begin
        select name from sport where sport.nusport = nusport;
    end;

create procedure getIdSport( name VARCHAR(20))
    begin
        select nusport from sport where sport.name = name;
    end;


create procedure getProductBySize( size varchar(3))
    begin
        select * from product where idproduct in (select distinct nuproduct from catalog where catalog.size = size);
    end;

create procedure getProductByColor( color varchar(20))
    begin
        select * from product where idproduct in (select distinct nuproduct from catalog where catalog.color = color);
    end;

create procedure getProductBySportType( sport integer,  type varchar(15))
    BEGIN
        select * from product where nusport = sport and type = product.type;
    end;

create procedure verifyLogin( loginSearch VARCHAR(255))
    begin
        select login from user where loginSearch = login;
    end;

-- verify que email existe dans la base de données
create procedure verifyEmail( mailSearch VARCHAR(255))
    begin
        select login from user where id in (select id from information where mailSearch = information.mail);
    end;

-- verify que mobile existe dans la base de données
create procedure verifyPhone( phone int)
    begin
        select login from user where id in (select id from information where phone = mobile);
    end;

create procedure verifyId( newId int)
    begin
        select login from user where newId = id;
    end;

create procedure getUserByLogin( loginSearch VARCHAR(255))
    begin
        select login, id from user where login = loginSearch;
    end;

-- on retourne l'user en fonction de son id
create procedure getUserById( idSearch VARCHAR(255))
    begin
        select id, login ,cookieId, status from user where id = idSearch;
    end;

-- récupère l'id et l'email de l'user à partir de son email
create procedure getUserByEmail( mailSearch VARCHAR(255))
    begin
        select login, id from user where id in (select id from information where mailSearch = information.mail);
    end;

create procedure getPasswordById( idSearch VARCHAR(255))
    begin
        select password, salt from user where id = idSearch;
    end;

create procedure getStatusById( idSearch VARCHAR(255))
    begin
        select status from user where id = idSearch;
    end;

create procedure loginMail( mail VARCHAR(255))
    begin
        select password from user where id in (select id from information where mail = information.mail);
    end;

create procedure getProductById( id integer)
    begin
        select * from product where idproduct = id;
    end;

create procedure getStock( id integer)
    begin
        select * from catalog where nuproduct = id;
    end;

create procedure getStockTotal( id integer)
    begin
        select sum(quantity) from catalog where nuproduct = id;
    end;

create procedure countWordCapchat( newWord varchar(20),  ipAddress varchar(45),  expiration int)
    begin

        select count(*)   count from captcha where word = newWord and ip_address = ipAddress and captcha_time > expiration;

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


create procedure addUser( newid integer, newlogin varchar(255),  newpass varchar(255),  newsalt VARCHAR(45),  newstatus varchar(20))
    BEGIN
        insert into user(id, login,password,salt,status) value (newid, newlogin,newpass,newsalt, newstatus);
    end;

create procedure addCoordonnee( newid int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int)
    BEGIN
        insert into information(id,firstname,name,mail,mobile,fix) value (newid,newprenom,newnom,newmail,newmobile,newfixe);
    end;

create procedure createUser( newId integer,  newLogin varchar(255),  newPass varchar(255),  newSalt varchar(45),  newPrenom varchar(255),  newNom varchar(255),  newEmail varchar(255),  newMobile int,  newFixe int)
    begin
        insert into user(id, login, password, salt, status) value (newId, newLogin, newPass, newSalt, 'Client');
        insert into information(id, firstname, name, mail, mobile, fix) value (newId, newPrenom, newNom, newEmail, newMobile, newFixe);
    end;

create procedure addLocalisation( newidadresse int,  newid int,  newadresse varchar(255),  newcode int,  newville varchar(255),  newdep varchar(255),  newpays varchar(255))
    BEGIN
        insert into location(idlocation,id,location,codepostal,city,department,country) value (newidadresse,newid,newadresse,newcode,newville,newdep,newpays);
    end;

create procedure addProduct( newid int,  newtype varchar(15),  newnusport int,  newmarque varchar(255),  newnom varchar(255), newgenre varchar(5),  newprix float,  newdesc varchar(255),  newimage varchar(255))
    BEGIN
        insert into product(idproduct, type, nusport, brand, name, gender, price, description, image) value (newid, newtype,newnusport,newmarque,newnom,newgenre,newprix,newdesc,newimage);
    end;

create procedure addCommande( newid int,  newdate varchar(10),  newproduit int,  newquantite int,  newclient int, newadresse int,  newetat varchar(15))
    BEGIN
        insert into `order`(idorder, dateorder, idproduct, quantity, iduser,idlocation , state) value (newid, newdate,newproduit,newquantite,newclient,newadresse,newetat);
    end;

create procedure addCatalogue( newid int, newreference int , newproduit int,  newcouleur varchar(20),  newtaille varchar(3),  newquantite int)
    BEGIN
        insert into catalog(id, reference, nuproduct, color, size,quantity) value (newid, newreference,newproduit,newcouleur,newtaille,newquantite);
    end;

create  procedure addCaptchat( captchaTime int,  ipAddress varchar(45),  newWord varchar(20))
    BEGIN

        insert into captcha(captcha_time, ip_address, word) value (captchaTime, ipAddress, newWord);

    end;

-- Call addCaptchat(123, '::1', 'azerty');

#---------- Suppression ----------------

create procedure delUser( iduser int)
    BEGIN
        delete from user where id = iduser;
        delete from information where id = iduser;
        delete from location where id = iduser;
    end;

create procedure delProduct( nuproduct int)
    BEGIN
        delete from product where idproduct = nuproduct;
        delete from catalog where catalog.nuproduct = nuproduct;
    end;

create procedure delVariante( idvariante int)
    begin
        delete from catalog where id = idvariante;
    end;

create procedure cleanCaptchat( expiration int)
    begin

        delete from captcha where captcha_time < expiration;

    end;

#---------- Update ----------------


create procedure updateQuantite( iduser int,  newquantity int)
    BEGIN
        update catalog set quantity=newquantity where id = iduser;
    end;

-- Ajout du CookieId
create procedure setCookieId( newCookieId varchar(45),  iduser int)
    BEGIN
        update user set cookieId=newCookieId where id = iduser;
    end;

-- Suppression du cookieId
create procedure delCookieId( iduser int)
    BEGIN
        update user set cookieId='' where id = iduser;
    end;

create procedure updateEtat( nuorder int, newstate varchar(15))
    BEGIN
        update `order` set state=newstate where idorder = nuorder;
    end;

create procedure updateAdresseCommande( nuorder int, newlocation varchar(15))
    BEGIN
        update `order` set idlocation=newlocation where idorder = nuorder;
    end;

create procedure updateCoordonnees( iduser int,  newfirstname varchar(255),  newname varchar(255),  newmail varchar(255),  newmobile int,  newfix int)
    BEGIN
        update information set firstname=newfirstname, name=newname, mail=newmail, mobile=newmobile, fix=newfix where id=iduser;
    end;

create procedure updateLocalisation( newidlocation int, iduser int,  newlocation varchar(255),  newcode int,  newcity varchar(255),  newdep varchar(255),  newcountry varchar(255))
    BEGIN
        update location set location=newlocation, codepostal=newcode, city=newcity, department=newdep, country=newcountry where id = iduser and idlocation=newidlocation;
    end;

create procedure updatePrice( nuproduct int,  newprice int)
    BEGIN
        update product set price=newprice where idproduct=nuproduct;
    end;

create procedure updateDescription( nuproduct int,  newdesc varchar(255))
    BEGIN
        update product set description=newdesc where idproduct=nuproduct;
    end;

create procedure updateImage( nuproduct int,  newimage varchar(255))
    BEGIN
        update product set image=newimage where idproduct=nuproduct;
    end;

create procedure updateUtilisateur( iduser int,  newlogin varchar(255),  newpass varchar(255))
    BEGIN
        update user set login=newlogin, password=newpass where id=iduser;
    end;

create procedure updateStatus( iduser int,  newstate varchar(20))
    BEGIN
        update user set status=newstate where id=iduser;
    end;

#---------- Arthur ----------------

create procedure getLocationById(idloc integer)
    Begin
        select * from location where idlocation = idloc;
    END;


create procedure updateLastName(targetId integer, newLastName varchar(255))
    BEGIN
        update information set name=newLastName where id = targetId;
    end;

create procedure updateFirstName(targetId integer, newFirstName varchar(255))
    BEGIN
        update information set firstname=newFirstName where id = targetId;
    end;
