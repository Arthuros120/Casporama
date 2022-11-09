DROP USER IF EXISTS 'arthur'@'%';
DROP USER IF EXISTS 'maximes'@'%';
DROP USER IF EXISTS 'maximef'@'%';
DROP USER IF EXISTS 'titouan'@'%';
DROP USER IF EXISTS 'site'@'%';


CREATE USER 'arthur'@'%' IDENTIFIED BY 'ArthurHamelin123$';
CREATE USER 'maximes'@'%' IDENTIFIED BY  'MaximeSantos123$';
CREATE USER 'maximef'@'%' IDENTIFIED BY 'MaximeFranco123$';
CREATE USER 'titouan'@'%' IDENTIFIED BY 'TitouanGautier123$';
CREATE USER 'site'@'%' IDENTIFIED BY 'Casporama123$';


GRANT ALL PRIVILEGES ON *.* TO 'arthur'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'maximes'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'maximef'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'titouan'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'site'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;