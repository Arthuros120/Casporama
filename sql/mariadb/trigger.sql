use CasporamaDEV;

SET sql_mode=ORACLE;

create or replace trigger TimeIsUp after update on location for each row
    begin
        if datediff(NEW.dateLastUpdate, CURRENT_DATE) >= 60  then
            delete from location where idlocation = NEW.idlocation;
            delete from `order` where `order`.idlocation = NEW.idlocation;
        end if;
    end;

create or replace trigger dateLastUpdate before update on user for each row
        begin
            if old.status != new.status then
                SET new.dateLastUpdate = NOW();
            end if;
        end;
