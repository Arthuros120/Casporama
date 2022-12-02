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

create or replace trigger TimeIsUp after update on location for each row
    begin
        if datediff(NEW.dateLastUpdate, CURRENT_DATE) >= 60  then
            delete from location where idlocation = NEW.idlocation;
            delete from `order` where `order`.idlocation = NEW.idlocation;
        end if;
    end


