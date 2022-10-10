DROP USER IF EXISTS 'arthur'@'%';
DROP USER IF EXISTS 'maximes'@'%';
DROP USER IF EXISTS 'maximef'@'%';
DROP USER IF EXISTS 'titouan'@'%';

CREATE USER 'arthur'@'%' IDENTIFIED WITH mysql_native_password BY 'arthur123';
CREATE USER 'maximes'@'%' IDENTIFIED WITH mysql_native_password BY  'maxime123';
CREATE USER 'maximef'@'%' IDENTIFIED WITH mysql_native_password BY 'maxime123';
CREATE USER 'titouan'@'%' IDENTIFIED WITH mysql_native_password BY 'titouan123';

GRANT ALL PRIVILEGES ON *.* TO 'arthur' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'maximes' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'maximef' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'titouan' WITH GRANT OPTION;