DROP USER IF EXISTS 'arthur'@'0.0.0.0';
DROP USER IF EXISTS 'maximes'@'0.0.0.0';
DROP USER IF EXISTS 'maximef'@'0.0.0.0';
DROP USER IF EXISTS 'titouan'@'0.0.0.0';

CREATE USER 'arthur'@'0.0.0.0' IDENTIFIED WITH mysql_native_password BY 'ArthurHamelin123$';
CREATE USER 'maximes'@'0.0.0.0' IDENTIFIED WITH mysql_native_password BY  'MaximeSantos123$';
CREATE USER 'maximef'@'0.0.0.0' IDENTIFIED WITH mysql_native_password BY 'MaximeFranco123$';
CREATE USER 'titouan'@'0.0.0.0' IDENTIFIED WITH mysql_native_password BY 'TitouanGautier123$';

GRANT ALL PRIVILEGES ON *.* TO 'arthur' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'maximes' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'maximef' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'titouan' WITH GRANT OPTION;

FLUSH PRIVILEGES;