use Casporama;

drop table if exists catalogue cascade;

drop table if exists commande cascade;

drop table if exists coordonnees cascade;

drop table if exists localisation cascade;

drop table if exists produit cascade;

drop table if exists sport cascade;

drop table if exists utilisateur cascade;

drop table if exists captcha cascade;

drop procedure if exists addCatalogue;

drop procedure if exists addCommande;

drop procedure if exists addCoordonnee;

drop procedure if exists addLocalisation;

drop procedure if exists addProduct;

drop procedure if exists addUser;

drop procedure if exists delCookieId;

drop procedure if exists delProduct;

drop procedure if exists delUser;

drop procedure if exists delVariante;

drop procedure if exists getIdSport;

drop procedure if exists getNameSport;

drop procedure if exists getPasswordById;

drop procedure if exists getProductByBrand;

drop procedure if exists getProductByColor;

drop procedure if exists getProductById;

drop procedure if exists getProductBySize;

drop procedure if exists getProductBySport;

drop procedure if exists getProductBySportType;

drop procedure if exists getProductByType;

drop procedure if exists getStatusById;

drop procedure if exists getStock;

drop procedure if exists getStockTotal;

drop procedure if exists getUserByLogin;

drop procedure if exists getUserByEmail;

drop procedure if exists  getUserById;

drop procedure if exists loginMail;

drop procedure if exists orderByPriceAsc;

drop procedure if exists orderByPriceDesc;

drop procedure if exists setCookieId;

drop procedure if exists updateAdresseCommande;

drop procedure if exists updateCoordonnees;

drop procedure if exists updateDescription;

drop procedure if exists updateEtat;

drop procedure if exists updateImage;

drop procedure if exists updateLocalisation;

drop procedure if exists updatePrice;

drop procedure if exists updateQuantite;

drop procedure if exists updateStatus;

drop procedure if exists updateUtilisateur;

drop procedure if exists verifyLogin;

drop procedure if exists verifyEmail;

drop procedure if exists delCookieId;

drop procedure if exists addCaptchat;

drop procedure if exists cleanCaptchat;