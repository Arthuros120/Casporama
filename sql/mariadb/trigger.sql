/*

create or replace trigger DelUtilisateur BEFORE DELETE ON utilisateur
BEGIN 
 Delete from commande where idclient = ID;
END

create or replace trigger DelProduit BEFORE DELETE ON produit p
BEGIN 
 Delete from commande s where s.idproduit = p.idproduit;
END

create or replace trigger DelLocal BEFORE DELETE ON localisation loc
BEGIN 
 Delete from commande s where s.idadresse = loc.idadresse;
END

*/

use CasporamaDEV;

SET sql_mode=ORACLE;

create or replace trigger isAlive after update on location for each row
    begin
        if NEW.isALive = false and NEW.idlocation not in (select `order`.idlocation from `order`) then
            delete from location where idlocation = NEW.idlocation;
        end if;
    end;


