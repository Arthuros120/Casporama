
DROP USER IF EXISTS 'arthur'@'0.0.0.0';
DROP USER IF EXISTS 'maximes'@'0.0.0.0';
DROP USER IF EXISTS 'maximef'@'0.0.0.0';
DROP USER IF EXISTS 'titouan'@'0.0.0.0';

DROP USER IF EXISTS 'arthur'@'%';
DROP USER IF EXISTS 'maximes'@'%';
DROP USER IF EXISTS 'maximef'@'%';
DROP USER IF EXISTS 'titouan'@'%';

DROP DATABASE db_itconnect;

CREATE DATABASE db_itconnect;

CREATE USER 'arthur'@'%' IDENTIFIED WITH mysql_native_password BY 'ArthurHamelin123$';
CREATE USER 'maximes'@'%' IDENTIFIED WITH mysql_native_password BY  'MaximeSantos123$';
CREATE USER 'maximef'@'%' IDENTIFIED WITH mysql_native_password BY 'MaximeFranco123$';
CREATE USER 'titouan'@'%' IDENTIFIED WITH mysql_native_password BY 'TitouanGautier123$';

GRANT ALL PRIVILEGES ON db_itconnect.* TO 'arthur'@'%' IDENTIFIED BY 'ArthurHamelin123$' WITH GRANT OPTION;


GRANT ALL PRIVILEGES ON *.* TO 'arthur'@'%';
GRANT ALL PRIVILEGES ON *.* TO 'maximes'@'%';
GRANT ALL PRIVILEGES ON *.* TO 'maximef'@'%';
GRANT ALL PRIVILEGES ON *.* TO 'titouan'@'%';

FLUSH PRIVILEGES;