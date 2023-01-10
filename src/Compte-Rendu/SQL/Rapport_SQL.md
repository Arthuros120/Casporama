# SAE - SQL

## 3 - Package

### Package sport

| Nom  | Paramètre entrant | Paramètres sortant | Commentaires |
| ------- | -------- | ------- | -------- |
| getNameSport   | nusport int | Nom du sport qui est associé à nusport | Permet d'avoir le nom du sport en fonction de son id |
| getIdSport | name varchar | Id du sport associé  à name | Permet d'avoir l'id du sport en fonction de son nom |
| getAll | | Toutes les lignes de la table sport | Permet de récupérer toutes les informations sur les sports |

### Package user

| Nom  | Paramètre entrant | Paramètres sortant | Commentaires |
| ------- | -------- | ------- | -------- |
| verifyLogin | loginSearch varchar |  | Permet de vérifier si un login donnée est présent dans la BD |
| verifyEmail | mailSearch | | Permet de vérifier si un mail donnée est présent dans la BD |
| verifyPhone | phone int | | Permet de vérifier si un Numéro de téléphone donnée est présent dans la BD |
| verifyId | newId int | | Permet de vérifier si un ID donnée est présent dans la BD |
| getUserByLogin | loginSearch varchar | | Permet de récupérer un user par son login |
| getUserById | idSearch varhcar |  | Permet de récupérer un user par son ID |
| getUserByEmail | mailSearch varchar |  | Permet de récupérer un user par son adresse mail |
| getPasswordById | idSearch int |  | Permet de récupérer un mot de passe par un ID |
| getStatusById | idSearch int |  | Permet de récupérer un status par un ID |
| getUserInfoById | idUser int |  | Permet de récupérer les information d'un user à partir de son id |
| getUserLocationById | idUser int |  | Permet de récupérer la Location d'un user avec son ID |
| loginMail | mail varchar |  | Permet de récupérer un mot de passe par une adresse mail |
| addUser | newid int, newlogin varchar,  newpass varchar,  newsalt varchar, newcookie varchar, newstatus varchar, newverif boolean, newalive boolean, newdate datetime | | Permet d'ajouter un user |
| addInformation | newid int,  newfirstname varchar,  newname varchar,  newmail varchar,  newmobile int,  newfix int | | Permet d'ajouter les coordonnées d'un user par son ID |
| createUser | newId int,  newLogin varchar,  newPass varchar,  newSalt varchar,  newfirstname varchar,  newname varchar,  newEmail varchar,  newMobile int,  newFix int, dateLastUpdate date | | Permet d'ajouter un user et ses coordonnées |
| delUser | iduser int | - | Permet de supprimer un user, ses coordonnées et sa location |
| setCookieId | newCookieId varchar(45),  iduser int | - | Permet d'ajouter un cookie à un user |
| delCookieId | iduser int | - | Permet de supprimer le cookie d'un user |
| updateCoordonnees | iduser int,  newfirstname varchar(255),  newname varchar(255),  newmail varchar(255),  newmobile int,  newfix int | - | Permet de mettre à jour les différentes coordonnées d'un user |
| updateLocalisation | newidlocation int, iduser int, newname varchar(255)  ,newlocation varchar(255),  newcode int,  newcity varchar(255),  newdep varchar(255),  newcountry varchar(255) | - | Permet de mettre à jour les différentes localisations d'un user |
| updateUtilisateur | iduser int,  newlogin varchar(255),  newpass varchar(255) | - | Permet de mettre à jour un user |
| updateStatus | iduser int,  newstatus varchar(20) | - | Permet de mettre à jour le status d'un user |
| getLocationById | idloc integer | - | Permet de connaitre la Location d'un user à partir de son id |
| updateLastName | targetId integer, newLastName varchar(255) | - | Permet de mettre à jour le nom de famille du User |
| updateFirstName | targetId integer, newFirstName varchar(255) | - | Permet de mettre à jour le prénom du user |
| updateEmail | targetId integer, newMail varchar(255) | - | Permet de mettre à jour l'email du user |
| updateMobile | targetId integer, newMobile varchar(255) | - | Permet de mettre à jour le numéros de téléphone portable du user |
| updateFixe | targetId integer, newFixe varchar(255) | - | Permet de mettre à jour le numéros de téléphone fixe du user |
| updatePassword | targetId integer, newPass varchar(255), newSalt varchar(45) | - | Permet de mettre à jour le password du user |
| verifySalt | newSalt varchar(255) | - | Permet de vérifier que le sel n'est pas déja présent dans la BD |
| getLocationByIdAndUserId | idUser int, idLoc int | - | Permet de trouver une location d'un user |
| isUniqueAddressName | searchName varchar(255), searchIdUser int | - | Permet de vérifier que le nom de l'adresse ne figure pas déjà dans les adresses du user |
| getAddresseById | searchId int | - | Permet de récupérer l'adresse avec l'id du user |
| verifyLocId | searchId int | - | Permet de récupérer le nom d'une location grace à son id |
| updateLocById | searchId int, newId int, idUser int, newLocName varchar(255), newLocAddress varchar(255), newLocCode int, newLocCity varchar(255), newLocDep varchar(255), newLocCountry varchar(255), newLocLat double, newLocLong double, newIsDefault bool, dateCreation date | - | Permet de mettre à jour une Location avec son id |
| addressIsDead | searchId int, newDateLastUpdate datetime | - | Permet de vérifier si une adresse est en morte |
| countAddressByIdAndName | searchId int, searchName varchar(255) | - | Permet de compter le nombre d'adresse ayant le meme nom et le meme id que celui donné en paramètre |
| createLoc | newId int, idUser int, newLocName varchar(255), newLocAddress varchar(255), newLocCode int, newLocCity varchar(255), newLocDep varchar(255), newLocCountry varchar(255), newLocLat double, newLocLong double, newIsDefault bool, dateCreation date | - | Permet de créer une Location |
| sameAddresse | searchUserId int, searchAddress varchar(255), searchCity varchar(255) | - | Permet de vérifier si deux adresses sont pareilles, renvoie le nombre d'adresses identiques |
| sameAddresseModif | searchUserId int, searchAddress varchar(255), searchCity varchar(255) | - | Permet de vérifier si deux adresses sont pareilles, renvoie le nombre d'adresses identiques et l'id |
| countAliveAddressByUserId | searchUserId int | - | Permet de compter le nombre d'adresses actives par user |
| getAllUser | - | - | Permet de récupérer tous les users |
| getAllLocation | - | - | Permet de récupérer toutes les Locations |
| getAllInformation | - | - | Permet de récupérer toutes les Informations |
| getIsVerifiedById | idSearch VARCHAR(255) | - | Permet de vérifier qu'un user est vérifié à partir de son id |
| getIsALiveById | idSearch VARCHAR(255) | - | Permet de vérifier si un user est en vie avec son id |
| getDateLastUpdateById | idSearch VARCHAR(255) | - | Permet de récupérer la date du dernier update d'un user avec son id |
| userIsDead | searchId int, newDateLastUpdate date | - | Permet de mettre un user mort avec son id |
| setUserVerified | searchId int, newDate datetime | - | Permet de vérifier un user avec son id |
| changeStatus | searchId int, newStatus varchar(255) | - | Permet de changer le status de l'user |

### Package product

| Nom | Paramètre Entrant | Paramètre Sortant | Commentaire |
| --- | ---               | ---               | ---         |
| getProductBySport | sport integer | - | Permet d'avoir les différents produits d'un sport spécifique |
| getProductByType | type varchar(15) | - | Permet d'avoir les différents produits d'un type spécifique |
| getProductByBrand | brand varchar(255) | - | Permet d'avoir les différents produits d'une marque spécifique |
| orderByPriceAsc | - | - | Permet d'avoir les différents produits trié par prix croissant |
| orderByPriceDesc | - | - | Permet d'avoir les différents produits trié par prix décroissant |
| getProductBySize | size varchar(3) | - | Permet d'avoir les différents produits d'une taille spécifique |
| getProductByColor | color varchar(20) | - | Permet d'avoir les différents produits d'une couleur spécifique |
| getProductBySportType | sport integer, type varchar(15) | - | Permet d'avoir les différents produits d'un sport et d'un type spécifique |
| getProductById | id integer | - | Permet d'avoir un product par son ID |

