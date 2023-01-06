use CasporamaDEV;

SET sql_mode=ORACLE;

-- Les packages sont construit en fonction des différentes tables présentes dans la base de donnée

CREATE OR REPLACE PACKAGE sport AS
    -- Permet d'avoir le nom du sport en fonction de son id
    procedure getNameSport( nusport integer);
    -- Permet d'avoir l'id du sport en fonction de son nom
    procedure getIdSport( name VARCHAR(20));
    procedure getAll();
END;

CREATE OR REPLACE PACKAGE BODY sport AS
    procedure getAll() as
    Begin
        select * from sport;
    End;
  procedure getNameSport( nusport integer) as
    begin
        select name from sport where sport.nusport = nusport;
    end;

  procedure getIdSport( name VARCHAR(20)) as
    begin
        select nusport from sport where sport.name = name;
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
    procedure getUserInfoById(iduser integer);
    procedure getUserLocationById(iduser int);
    procedure loginMail( mail VARCHAR(255));
    -- Permet d'ajouter un user
    procedure addUser( newid integer, newlogin varchar(255),  newpass varchar(255),  newsalt VARCHAR(45), newcookie varchar(45), newstatus varchar(20), newverif boolean, newalive boolean, newdate datetime);
    -- Permet d'ajouter les coordonnées d'un user par son ID
    procedure addInformation( newid int,  newfirstname varchar(255),  newname varchar(255),  newmail varchar(255),  newmobile int,  newfix int);
    -- Permet d'ajouter un user et ses coordonnées
    procedure createUser( newId integer,  newLogin varchar(255),  newPass varchar(255),  newSalt varchar(45),  newfirstname varchar(255),  newname varchar(255),  newEmail varchar(255),  newMobile int,  newFix int, dateLastUpdate date);
    -- Permet d'ajouter une location à un user
    procedure addLocation( newidlocation int,  newid int, newname varchar(255), newlocation varchar(255),  newcode int,  newcity varchar(255),  newdep varchar(255),  newcountry varchar(255), newlat double,  newlng double, newisDefault
    boolean, newisALive boolean, newDate datetime);
    -- Permet de supprimer un user, ses coordonnées et sa location
    procedure delUser( iduser int);
    -- Permet d'ajouter un cookie à un user
    procedure setCookieId( newCookieId varchar(45),  iduser int);
    -- Permet de supprimer le cookie d'un user
    procedure delCookieId( iduser int);
    -- Permet de mettre à jour les différentes coordonnées d'un user
    procedure updateCoordonnees( iduser int,  newfirstname varchar(255),  newname varchar(255),  newmail varchar(255),  newmobile int,  newfix int);
    -- Permet de mettre à jour les différentes localisations d'un user
    procedure updateLocalisation( newidlocation int, iduser int, newname varchar(255)  ,newlocation varchar(255),  newcode int,  newcity varchar(255),  newdep varchar(255),  newcountry varchar(255));
    -- Permet de mettre à jour un user
    procedure updateUtilisateur( iduser int,  newlogin varchar(255),  newpass varchar(255));
    -- Permet de mettre à jour le status d'un user
    procedure updateStatus( iduser int,  newstatus varchar(20));
    procedure getLocationById(idloc integer);
    procedure updateLastName(targetId integer, newLastName varchar(255));
    procedure updateFirstName(targetId integer, newFirstName varchar(255));
    procedure updateEmail(targetId integer, newMail varchar(255));
    procedure updateMobile(targetId integer, newMobile varchar(255));
    procedure updateFixe(targetId integer, newFixe varchar(255));
    procedure updatePassword(targetId integer, newPass varchar(255), newSalt varchar(45));
    procedure verifySalt(newSalt varchar(255));
    procedure getLocationByIdAndUserId(idUser int, idLoc int);
    procedure isUniqueAddressName(searchName varchar(255), searchIdUser int);
    procedure getAddresseById(searchId int);
    procedure verifyLocId(searchId int);
    procedure updateLocById(
        searchId int,
        newId int,
        idUser int,
        newLocName varchar(255),
        newLocAddress varchar(255),
        newLocCode int,
        newLocCity varchar(255),
        newLocDep varchar(255),
        newLocCountry varchar(255),
        newLocLat double,
        newLocLong double,
        newIsDefault bool,
        dateCreation date
        );
    procedure addressIsDead(searchId int, newDateLastUpdate datetime);
    procedure countAddressByIdAndName(searchId int, searchName varchar(255));
    procedure createLoc(
        newId int,
        idUser int,
        newLocName varchar(255),
        newLocAddress varchar(255),
        newLocCode int,
        newLocCity varchar(255),
        newLocDep varchar(255),
        newLocCountry varchar(255),
        newLocLat double,
        newLocLong double,
        newIsDefault bool,
        dateCreation date
        );
    procedure sameAddresse(searchUserId int, searchAddress varchar(255), searchCity varchar(255));
    procedure sameAddresseModif(searchUserId int, searchAddress varchar(255), searchCity varchar(255));
    procedure countAliveAddressByUserId(searchUserId int);
    procedure getAllUser();
    procedure getAllLocation();
    procedure getAllInformation();
    procedure getIsVerifiedById( idSearch VARCHAR(255));
    procedure getIsALiveById( idSearch VARCHAR(255));
    procedure getDateLastUpdateById( idSearch VARCHAR(255));
    procedure userIsDead(searchId int, newDateLastUpdate date);
    procedure setUserVerified(searchId int, newDate datetime);
    procedure changeStatus(searchId int, newStatus varchar(255));
END;

CREATE OR REPLACE PACKAGE BODY user AS
    procedure getAllUser() as
    Begin
        select * from user;
    End;
    procedure getAllLocation() as
    Begin
        select * from location;
    End;
    procedure getAllInformation() as
    Begin
        select * from information;
    End;
    procedure getAddresseById(searchId int) as
    Begin
        select name, location, codepostal, city, department, latitude, longitude, isDefault from location where id = searchId;
    End;
    procedure isUniqueAddressName(searchName varchar(255), searchIdUser int) as
    Begin
        select count(*) as count from location where name = searchName and id = searchIdUser and isALive = true;
    END;
    procedure getLocationByIdAndUserId(idUser int, idLoc int) as
    Begin
        select * from location where id = iduser and idlocation = idloc;
    END;

    procedure verifySalt(newSalt varchar(255)) as
    begin
        select login from user where newSalt = salt;
    end;

    procedure updatePassword(targetId integer, newPass varchar(255), newSalt varchar(45)) as
    BEGIN
        update user set password=newPass, salt=newSalt where id = targetId;
    end;
    procedure updateFixe(targetId integer, newFixe varchar(255)) as
    BEGIN
        update information set fix=newFixe where id = targetId;
    end;
    procedure updateMobile(targetId integer, newMobile varchar(255)) as
    BEGIN
        update information set mobile=newMobile where id = targetId;
    end;
    procedure updateEmail(targetId integer, newMail varchar(255)) as
    BEGIN
        update information set mail=newMail where id = targetId;
    end;
    procedure updateFirstName(targetId integer, newFirstName varchar(255)) as
    BEGIN
        update information set firstname=newFirstName where id = targetId;
    end;
    procedure updateLastName(targetId integer, newLastName varchar(255)) as
    BEGIN
        update information set name=newLastName where id = targetId;
    end;
    procedure getLocationById(idloc integer) as
    Begin
        select * from location where idlocation = idloc;
    END;
    procedure getUserLocationById(iduser int) as
    Begin
        select * from location where id = iduser;
    END;
    procedure getUserInfoById(iduser integer) as
    Begin
        select * from information where id = iduser;
    END;
    procedure verifyLogin( loginSearch VARCHAR(255)) as
    begin
        select login from user where loginSearch = login;
    end;

    procedure verifyEmail( mailSearch VARCHAR(255)) as
    begin
        select login from user where id in (select id from information where mailSearch = information.mail);
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
        select id, login ,cookieId, status, isVerified, isALive from user where id = idSearch;
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

    procedure addUser( newid integer, newlogin varchar(255),  newpass varchar(255),  newsalt VARCHAR(45), newcookie varchar(45), newstatus varchar(20), newverif tinyint(1), newalive tinyint(1), newdate datetime) as
    BEGIN
        insert into user(id, login,password,salt,cookieId,status,isVerified,isALive,dateLastUpdate) value (newid, newlogin,newpass,newsalt, newcookie, newstatus, newverif, newalive,newdate);
    end;

    procedure addInformation( newid int,  newprenom varchar(255),  newnom varchar(255),  newmail varchar(255),  newmobile int,  newfixe int) as
    BEGIN
        insert into information(id,firstname,name,mail,mobile,fix) value (newid,newprenom,newnom,newmail,newmobile,newfixe);
    end;

    procedure createUser( newId integer,  newLogin varchar(255),  newPass varchar(255),  newSalt varchar(45),  newPrenom varchar(255),  newNom varchar(255),  newEmail varchar(255),  newMobile int,  newFixe int, dateLastUpdate date) as
    begin
        insert into user(id, login, password, salt, status, isALive, dateLastUpdate) value (newId, newLogin, newPass, newSalt, 'Client', true, dateLastUpdate);
        insert into information(id, firstname, name, mail, mobile, fix) value (newId, newPrenom, newNom, newEmail, newMobile, newFixe);
    end;

    procedure addLocation( newidlocation int,  newid int, newname varchar(255), newlocation varchar(255),  newcode int,  newcity varchar(255),  newdep varchar(255),  newcountry varchar(255), newlat double,  newlng double, newisDefault
    boolean, newisALive boolean, newDate datetime) as
    BEGIN
        insert into location(idlocation,id,name,location,codepostal,city,department,country,latitude,longitude,isDefault,isALive,dateLastUpdate) value (newidlocation,newid,newname,newlocation,newcode,newcity,newdep,newcountry,newlat,newlng,newisDefault,newisALive,newDate);
    end;

    procedure delUser( iduser int) as
    BEGIN
        delete from user where id = iduser;
        delete from information where id = iduser;
        delete from location where id = iduser;
        delete from verifKey where idUser = delUser.iduser;
    end;

    procedure setCookieId( newCookieId varchar(45),  iduser int) as
    BEGIN
        update user set cookieId=newCookieId where id = iduser;
    end;

    procedure delCookieId( iduser int) as
    BEGIN
        update user set cookieId='' where id = iduser;
    end;

    procedure updateCoordonnees( iduser int,  newfirstname varchar(255),  newname varchar(255),  newmail varchar(255),  newmobile int,  newfix int) as
    BEGIN
        update information set firstname=newfirstname, name=newname, mail=newmail, mobile=newmobile, fix=newfix where id=iduser;
    end;

    procedure updateLocalisation( newidlocation int, iduser int, newname varchar(255)  ,newlocation varchar(255),  newcode int,  newcity varchar(255),  newdep varchar(255),  newcountry varchar(255)) as
    BEGIN
        update location set name=newname, location=newlocation, codepostal=newcode, city=newcity, department=newdep, country=newcountry where id = iduser and idlocation=newidlocation;
    end;

    procedure updateUtilisateur( iduser int,  newlogin varchar(255),  newpass varchar(255)) as
    BEGIN
        update user set login=newlogin, password=newpass where id=iduser;
    end;

    procedure updateStatus( iduser int,  newstate varchar(20)) as
    BEGIN
        update user set status=newstate where id=iduser;
    end;

    procedure verifyLocId(searchId int) as
    begin
        select `name` from location where idlocation = searchId;
    end;

    procedure addressIsDead(searchId int, newDateLastUpdate datetime) as
    begin
        update location set dateLastUpdate=newDateLastUpdate, isALive = false where idlocation = searchId;
        delete from location where isALive = false and idlocation not in (select o.idlocation from `order` o);
    end;

    procedure updateLocById(
        searchId int,
        newId int,
        idUser int,
        newLocName varchar(255),
        newLocAddress varchar(255),
        newLocCode int,
        newLocCity varchar(255),
        newLocDep varchar(255),
        newLocCountry varchar(255),
        newLocLat double,
        newLocLong double,
        newIsDefault bool,
        dateCreation datetime
        ) as
    begin

        update location set isDefault = false, isALive = false, dateLastUpdate = dateCreation where idlocation = searchId;
        insert into location(
                             idlocation,
                             id,
                             name,
                             location,
                             codepostal,
                             city,
                             department,
                             country,
                             latitude,
                             longitude,
                             isDefault,
                             isALive,
                             dateLastUpdate) value (
                                             newId,
                                             idUser,
                                             newLocName,
                                             newLocAddress,
                                             newLocCode,
                                             newLocCity,
                                             newLocDep,
                                             newLocCountry,
                                             newLocLat,
                                             newLocLong,
                                             newIsDefault,
                                             true,
                                             dateCreation
                                            );
    end;

    procedure countAddressByIdAndName(searchId int, searchName varchar(255)) as
    begin
        select count(*) as total from location where id = searchId and name = searchName and isALive=true;
    end;

    procedure createLoc(
        newId int,
        idUser int,
        newLocName varchar(255),
        newLocAddress varchar(255),
        newLocCode int,
        newLocCity varchar(255),
        newLocDep varchar(255),
        newLocCountry varchar(255),
        newLocLat double,
        newLocLong double,
        newIsDefault bool,
        dateCreation datetime
        ) as
    begin
        insert into location(
                             idlocation,
                             id,
                             name,
                             location,
                             codepostal,
                             city,
                             department,
                             country,
                             latitude,
                             longitude,
                             isDefault,
                             isALive,
                             dateLastUpdate) value (
                                             newId,
                                             idUser,
                                             newLocName,
                                             newLocAddress,
                                             newLocCode,
                                             newLocCity,
                                             newLocDep,
                                             newLocCountry,
                                             newLocLat,
                                             newLocLong,
                                             newIsDefault,
                                             true,
                                             dateCreation
                                            );
    end;

    procedure sameAddresse(searchUserId int, searchAddress varchar(255), searchCity varchar(255)) as
    begin
        select count(*) as total from location where id = searchUserId and location = searchAddress and city = searchCity and isALive=true;
    end;

    procedure sameAddresseModif(searchUserId int, searchAddress varchar(255), searchCity varchar(255)) as
    begin
        select count(*) as total, id from location where id = searchUserId and location = searchAddress and city = searchCity and isALive=true;
    end;

    procedure countAliveAddressByUserId(searchUserId int) as
    begin
        select count(*) as total from location where id = searchUserId and isALive=true;
    end;

    procedure getIsVerifiedById( idSearch VARCHAR(255)) as
    begin
        select isVerified from user where id = idSearch;
    end;

    procedure getIsALiveById( idSearch VARCHAR(255)) as
    begin
        select isALive from user where id = idSearch;
    end;

    procedure getDateLastUpdateById( idSearch VARCHAR(255)) as
    begin
        select dateLastUpdate from user where id = idSearch;
    end;

    procedure userIsDead(searchId int, newDateLastUpdate date) as
    begin
        update user set dateLastUpdate=newDateLastUpdate, isALive = false where id = searchId;
    end;

    procedure setUserVerified(idSearch int, newDate datetime) as
    begin
        update user set isVerified = true, dateLastUpdate = newDate where id = idSearch;
    end;

    procedure changeStatus(searchId int, newStatus varchar(255)) as
    begin
        update user set status = newStatus where id = searchId;
    end;
end;


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
    procedure addProduct( newid int,  newtype varchar(15),  newnusport int,  newmarque varchar(255),  newnom varchar(255), newgenre varchar(5),  newprix float,  newdesc varchar(255),  newimage text, newIsALive boolean, newDate datetime);    -- Permet de mettre à jour le prix d'un product
    procedure updatePrice( nuproduct int,  newprice int);
    -- Permet de mettre à jour la description d'un product
    procedure updateDescription( nuproduct int,  newdesc varchar(255));
    -- Permet de mettre à jour le chemin vers l'image d'un product
    procedure updateImage( nuproduct int,  newimage text);
    -- Permet de supprimer un product
    procedure delProduct( nuproduct int);
    procedure getAll();
    procedure getAllAsAlive();
    procedure getAllNotAlive();
    procedure getAllBrand();
    procedure getProductByName( newname varchar(255));
END;

CREATE OR REPLACE PACKAGE BODY product AS
    procedure getAllAsAlive() as
    Begin
        select * from product where isAlive = true;
    End;

    procedure getAllNotAlive() as
    Begin
        select * from product where isAlive = false;
    End;

    procedure getAll() as
    Begin
        select * from product;
    End;
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
        select * from product where product.brand = brand;
    end;

    procedure orderByPriceAsc() as
    BEGIN
        select * from product order by price ;
    end;

    procedure orderByPriceDesc() as
    BEGIN
        select * from product order by price desc ;
    end;

    procedure getProductBySize( size varchar(3)) as
    begin
        select * from product where idproduct in (select distinct nuproduct from catalog where catalog.size = size);
    end;

    procedure getProductByColor( color varchar(20)) as
    begin
        select * from product where idproduct in (select distinct nuproduct from catalog where catalog.color = color);
    end;

    procedure getProductBySportType( sport integer,  type varchar(15)) as
    BEGIN
        select * from product where nusport = sport and type = product.type and isALive = true;
    end;

    procedure getProductById( id integer) as
    begin
        select * from product where idproduct = id;
    end;

    procedure addProduct( newid int,  newtype varchar(15),  newnusport int,  newmarque varchar(255),  newnom varchar(255), newgenre varchar(5),  newprix float,  newdesc varchar(255),  newimage text, newIsALive boolean, newDate datetime) as
    BEGIN
        insert into product(idproduct, type, nusport, brand, name, gender, price, description, image, isALive, dateLastUpdate) value (newid, newtype,newnusport,newmarque,newnom,newgenre,newprix,newdesc,newimage, newIsALive, newDate);
    end;

    procedure delProduct( newnuproduct int) as
    BEGIN
        update product set isAlive = false, dateLastUpdate = NOW() where idproduct = newnuproduct;
        update catalog set isAlive = false, dateLastUpdate = NOW() where nuproduct = newnuproduct;
    end;

    procedure updatePrice( nuproduct int,  newprice int) as
    BEGIN
        update product set price=newprice where idproduct=nuproduct;
    end;

    procedure updateDescription( nuproduct int,  newdesc varchar(255)) as
    BEGIN
        update product set description=newdesc where idproduct=nuproduct;
    end;

    procedure updateImage( nuproduct int,  newimage text) as
    BEGIN
        update product set image=newimage where idproduct=nuproduct;
    end;

    procedure getAllBrand() as
    Begin
        select distinct brand from product;
    End;

    procedure getProductByName( newname varchar(255)) as
    Begin
        select * from product where name = newname;
    End;

END;

CREATE OR REPLACE PACKAGE `order` AS
    -- Permet d'avoir une commande par son ID
    procedure getOrderUserById( nuorder int, newiduser int);
    -- Permet d'avoir les commandes d'un client
    procedure getOrderUser( iduser int);
    -- Permet d'ajouter une commande à un client
    procedure addOrder(newid int, newiduser int, newdateorder datetime, newidlocation int, newstate varchar(15), newisalive bool, newdatelastupdate datetime);
    -- Permet d'ajouter un produit a une commande
    procedure addProductToOrder(newidorder int, newidproduct int , newidvariant int, newquantity int);
    -- Permet de mettre à jour l'état d'une commande
    procedure updateState( nuorder int, newstate varchar(15));
    -- Permet de mettre à jour l'adresse d'une commande
    procedure updateLocationOrder( nuorder int, newlocation varchar(15));
    procedure getAll();
    procedure verifyId(newid int);
    procedure delOrder(newidorder int);
END;

CREATE OR REPLACE PACKAGE BODY `order` AS
    procedure getAll() as
    Begin
        select * from `order`;
        select * from `order_products`;
    End;
    procedure getOrderUserById( nuorder int, newiduser int) as
    Begin
        select  o.id, iduser, date(dateorder) as 'dateorder', idlocation, state, isALive, dateLastUpdate, op.idproduct, idvariant, quantity
            from `order` o, order_products op
                where o.id = nuorder
                    and o.iduser = newiduser
                    and op.idorder = o.id;
    end;

    procedure getOrderUser( newiduser int) as
    Begin
        select  o.id
        from `order` o
        where o.iduser = newiduser;
    end;

    procedure addOrder(newid int, newiduser int, newdateorder datetime, newidlocation int, newstate varchar(15), newisalive bool, newdatelastupdate datetime) as
    BEGIN
        insert into `order`(id, iduser, dateorder, idlocation, state, isALive, dateLastUpdate ) value (newid,newiduser,newdateorder,newidlocation,newstate,newisalive,newdatelastupdate);
    end;

    procedure addProductToOrder(newidorder int, newidproduct int , newidvariant int, newquantity int) as
    BEGIN
        insert into order_products(idorder, idproduct, idvariant, quantity) value (newidorder,newidproduct,newidvariant,newquantity);
    end;

    procedure delOrder(newidorder int) as
    begin
        delete from `order` where id = newidorder;
        delete from order_products where idorder = newidorder;
    end;


    procedure updateState( nuorder int, newstate varchar(15)) as
    BEGIN
        update `order` set state=newstate where idorder = nuorder;
    end;

    procedure updateLocationOrder( nuorder int, newlocation varchar(15)) as
    BEGIN
        update `order` set idlocation=newlocation where idorder = nuorder;
    end;

    procedure verifyId(newid int) as
    begin
        select id from `order` where newid = id;
    end;
END;

CREATE OR REPLACE PACKAGE catalog AS
    -- Permet d'avoir le stock d'un product par son ID, donc toute les variantes existantes
    procedure getStock( id integer);
    -- Permet d'avoir le nombre total en stock d'un product
    procedure getStockTotal( id integer);
    -- Permet d'ajouter au Catalogue un nouveau product ou variante d'un product, la variante étant par exemple un même t-shirt mais de différente couleur ou taille
    procedure addCatalog( newid int,  newproduit int, newreference long , newcouleur varchar(20),  newtaille varchar(3),  newquantite int, newIsALive bool, newDate datetime);
    -- Permet de supprimer une variante
    procedure delVariante( idvariante int);
    -- Permet de mettre à jour la quantité d'une variante donnée
    procedure updateQuantity( idvariante int,  newquantity int);
    procedure updateALive(idvariante int, newstate bool);
    procedure getAll();
    procedure getCatalogByVariant(newidvariant int);
END;

CREATE OR REPLACE PACKAGE BODY catalog AS
    procedure getAll() as
    Begin
        select * from catalog;
    End;
    procedure getStock( id integer) as
    begin
        select * from catalog where nuproduct = id;
    end;

    procedure getStockTotal( id integer) as
    begin
        select sum(quantity) as total from catalog where nuproduct = id;
    end;

    procedure addCatalog( newid int,  newproduit int, newreference long , newcouleur varchar(20),  newtaille varchar(3),  newquantite int, newIsALive bool, newDate datetime) as
    BEGIN
        insert into catalog(id, nuproduct, reference, color, size,quantity, isALive, dateLastUpdate) value (newid, newproduit, newreference, newcouleur,newtaille,newquantite, newIsALive, newDate);
    end;

    procedure delVariante( idvariante int) as
    begin
        delete from catalog where id = idvariante;
    end;

    procedure updateQuantity( iduser int,  newquantity int) as
    BEGIN
        update catalog set quantity=newquantity where id = iduser;
    end;
    procedure getCatalogByVariant(newidvariant int) as
    begin
        select * from catalog where id = newidvariant;
    end;
    procedure updateALive(idvariante int, newstate bool) as
    begin
        update catalog set isALive=newstate where id = idvariant;
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

        select count(*)   count from captcha where word = newWord and ip_address = ipAddress and captcha_time > expiration;

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

CREATE OR REPLACE PACKAGE verifKey AS

    procedure verifyId(id varchar(54));
    procedure verifyKey(newKey varchar(6));
    procedure createKey(newId varchar(54), newKey varchar(6), newDateCreation datetime, newDateExpiration datetime, newIdUser int);
    procedure allIdKey();
    procedure deleteKey(searchId varchar(54));

    procedure checkCode(newId varchar(54), newKey varchar(6));
    procedure getIdByIdKey(newId varchar(6));

END;

CREATE OR REPLACE PACKAGE BODY verifKey AS

    procedure verifyId(searchId varchar(64)) as
    begin
        select id from verifKey where id = searchId;
    end;

    procedure verifyKey(newKey varchar(6)) as
    begin
        select keyValue from verifKey where keyValue = newKey;
    end;

    procedure createKey(newId varchar(64), newKey varchar(6), newDateCreation datetime, newDateExpiration datetime, newIdUser int) as
    begin
        delete from verifKey where idUser = newIdUser;
        insert into verifKey(id, keyValue, dateCreation, dateExpiration, idUser) values (newId, newKey, newDateCreation, newDateExpiration, newIdUser);
    end;

    procedure allIdKey() as
    begin
        select id from verifKey;
    end;

    procedure deleteKey(searchId varchar(64)) as
    begin
        delete from verifKey where id = searchId;
    end;

    procedure checkCode(newId varchar(64), newKey varchar(6)) as
    begin
        select idUser, dateExpiration from verifKey where id = newId and keyValue = newKey;
    end;

    procedure getIdByIdKey(newId varchar(64)) as
    begin
        select idUser from verifKey where id = newId;
    end;
END;

create or replace package cart as
    procedure getCart();
    procedure addCart(newid int, newiduser int, newidcart int, newidvariant int, newquantity int, newdate datetime, newdatexp datetime);
    procedure verifyId(id int);
    procedure getCartById(newid int);
    procedure maxIdCart(newid int);
    procedure modifyQuantity(newquantity int, user int, cart int, variant int);
    procedure deleteCart(newidcart int, newiduser int);
    procedure deleteProductDB(newiduser int, newid int);
    procedure getCartIdcart(newiduser int ,newidcart int);
End;

create or replace package body cart as
    procedure getCart() as
    begin
        select * from cart;
    end;
    procedure getCartById(newid int) as
    begin
        select * from cart where newid = iduser;
    end;
    procedure addCart(newid int, newiduser int, newidcart int, newidvariant int, newquantity int, newdate datetime, newdatexp datetime) as
    begin
        insert into cart(id,iduser,idcart,idvariant,quantity,date,dateExp) values(newid,newiduser,newidcart,newidvariant,newquantity,newdate,newdatexp);
    end;
    procedure verifyId(newid int) as
    begin
        select idcart from cart where newid = id;
    end;
    procedure maxIdCart(newid int) as
    begin
        select MAX(idcart) max from cart where iduser=newid;
    end;
    procedure modifyQuantity(newquantity int, user int, cart int, variant int) as
    begin
        update cart set quantity=newquantity where iduser = user and idcart = cart and idvariant = variant;
    end;
    procedure deleteCart(newidcart int, newiduser int) as
    begin
        delete from cart where idcart=newidcart and iduser=newiduser;
    end;
    procedure deleteProductDB(newiduser int, newid int) as
    begin
        delete from cart where iduser = newiduser and newid = id;
    end;
    procedure getCartIdcart(newiduser int ,newidcart int) as
    begin
        select * from cart where newidcart = idcart and newiduser = iduser;
    end;
end;



/*
use Casporama;
call `order`.getCommandeClient(6);
Call product.getProductBySportType(1, 'Vetement');
*/

/*call user.sameAddresse(2, '78;Boulevard Jules Verne', 'Nantes')*/

/*call user.countAliveAddressByUserId(2);*/

call order.getOrderUserById(1,2);

desc user;

call user.sameAddresseModif(2, '22;Rue des bergeronnettes', 'Nantes');

call verifKey.getIdByIdKey('8b88e9f89da11a88a28d00225843252fd65995a72d1290cd6618728527b6003e');

call sport.getAll();
