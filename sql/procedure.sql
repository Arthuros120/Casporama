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


create procedure loginUsername(IN username VARCHAR(255))
    begin
        select password from utilisateur where username = login;
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


#---------- Ajout ----------------


create procedure addUser(IN newlogin varchar(255), IN newpass varchar(255), IN newstatus varchar(20))
    BEGIN
        insert into utilisateur(login,password,status) values (newlogin,newpass,newstatus);
    end;

create procedure addCoordonnee(IN newid int, IN newprenom varchar(255), IN newnom varchar(255), IN newmail varchar(255), in newmobile int, in newfixe int)
    BEGIN
        insert into coordonnees(id,prenom,nom,mail,mobile,fixe) values (newid,newprenom,newnom,newmail,newmobile,newfixe);
    end;
