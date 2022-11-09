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
END;