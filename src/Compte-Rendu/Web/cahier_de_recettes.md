# Cahier de recettes

### Groupe :

- Arthur Hamelin
- Titouan Gautier
- Luna Manson
- Maxime Santos-Pereira 

## Sections :

- Home
- Shop 
- User
- Info
- Admin
- Cart
- Caspor
- Order
- DAO/Import_Export de donnée

### Home

| Fonction | Paramètres | Description               | Est déployé ? |
|:-------- | ---------- |:------------------------- |:------------- |
| Index    | /          | Affiche la page d'acceuil | Oui           |

### Shop

| Fonction | Paramètres             | Description                                 | Est déployé ? |
|:-------- | ---------------------- |:------------------------------------------- |:------------- |
| Home     | NomSport               | Affiche la page avec les                    | Oui           |
| View     | NomSport + TypeProduit | Affiche les produits du sport du type requi | Oui           |
| Product  | IdProduct              | Affiche le produit                          | Oui           |

### User

| Fonction             | Paramètres | Description                                                                     | Est déployé ? |
|:-------------------- | ---------- |:------------------------------------------------------------------------------- |:------------- |
| Index                | /          | Redirige vers User/Home                                                         | Oui           |
| Login                | /          | Affiche la page de connexion                                                    | Oui           |
| Logout               | /          | Déconnecte l'utilisateur                                                        | Oui           |
| Register             | /          | Affiche la page d'inscription n°1                                               | Oui           |
| RegisterUserIdentity | /          | Affiche la page d'inscription n°2                                               | Oui           |
| Home                 | /          | Affiche la page d'accueil avec les différents choses accessible a l'utilisateur | Oui           |


## Shop

| Fonctionnalité             |Description                                                                     | Est déployé ? |
|:-------------------- |:------------------------------------------------------------------------------- |:------------- |
| Filtrer Produit      | Filtre les produits par marque, prix maximum et minimum, mot clés               | Oui           |
| Afficher Produit par Sport | Les produits sont affiché par Sport, c'est à dire : Football, Badminton, Arts-Martiaux, Volleyball| Oui |
| Afficher produit par type | Les produits s'affichent par types, c'est à dire : Vêtements, Chaussures, Equipements| Oui |
| Séléctionner couleur du produits | Permet de choisir un variant du Produits | Oui |
| Sélectionner une taille | Permet de sélectionner une taille parmis celle disponible | Oui |
| Réduction | Le client peut bénéficier d'une promotion si il est Caspor | Oui |

## User

| Fonctionnalité             |Description                                                                     | Est déployé ? |
|:-------------------- |:------------------------------------------------------------------------------- |:------------- |
| Créer un compte | Créer un compte sur le site | Oui |
| Se connecter | Se connecter avec son login ou mail et mot de passe | Oui |
| Visualiser ces informations | Le client peut voir les informations qu'il à rentrer sur le site type mail, mobile... | Oui |
| Modifier mot de passe ||Oui|
|Modifier nom| | Oui |
|Modifier prénom||Oui|
|Modifier mail||Oui|
|Modifier téléphone mobile||Oui|
|Modifier téléphone fixe||Oui|
|Ajouter une adresse| Permet au client d'ajouter une adresse, il peut en ajouter jusqu'a 6 |Oui|
| Modifier une adresse | Le client peut modifier une adresse qu'il a enregistré | Oui |
| Supprimer une adresse | Le client peut supprimer une adresse enregistré | Oui |
| Supprimer son compte | l'utilisateurs peut supprimer son compte | Oui |
| Accéder au panier | L'utilisateurs peut accéder au panier, pour finaliser sa commande | Oui|
| Accéder aux comandes | Le client peut consulter ces commandes passées | Oui |
| Devenir Caspor | Le client peut devenir Caspor, un abonnement qui lui permet d'avoir certains avantage | Oui |
| Mot de passe oublié | Le client peut changer de mot de passe si il l'a oublié, il reçoit un mail pour le changer  | ~ |
| Réactiver son compte | Le client peut récupérer son compte dans un délais de 1 mois en contactant un administrateur | Oui |
| Vérifié compte | L'Utitlisateurs peut vérifié son compte via un mail qui lui est envoyé | Oui |


## Cart

| Fonctionnalité             |Description                                                                     | Est déployé ? |
|:-------------------- |:------------------------------------------------------------------------------- |:------------- |
| Ajouter un produit | Le client peut ajouter un produi au panier pour le commander | Oui |
| Enregistré son panier | Le client peut enregistrer son panierpour le consulter plsu tard | Oui |
| Choisir une addresse de livraison | Le client peut choisir son adresse de livraison parmis celle ajouter à son compte | Oui |
| Modifier la quantité s'un article | Il peut choisir la quantité d'un article dans le panier | Oui |
| Supprimer un article du panier | Il peut supprimer un article sans supprimé les autre | Oui |
| Supprimé un panier enregistré | Le client peut supprimer un panier enregistré  | Oui |


## Caspor

| Fonctionnalité             |Description                                                                     | Est déployé ? |
|:-------------------- |:------------------------------------------------------------------------------- |:------------- |
| Abonnement Caspor | Le CLient peut s'abonner au Caspor | Oui |
| Résilier l'abonnement | Il peut résilier l'abonnement Caspor  | Oui |
| Consulter la date du prochain paiement || Oui |
| Consulter la date d'abonnement | il peut voir le jour ou il est devenu Caspor | Oui |
| Consulter son temps d'abonnement || Oui |

## Order

| Fonctionnalité             |Description                                                                     | Est déployé ? |
|:-------------------- |:------------------------------------------------------------------------------- |:------------- |
| Consulter commandes | Le client peut voir toutes ses commandes | Oui |
| Télécharger les factures | Le client peut voir la facture d'une de ses commandes | Oui |
| Annuler commandes | Le client peut annuler la commande si elle n'est pas encore préparé | Oui |

## Admin

| Fonctionnalité             |Description                                                                     | Est déployé ? |
|:-------------------- |:------------------------------------------------------------------------------- |:------------- |
| Consulter les produits disponible | L'Admin peut consulter tout les produits disponible sur le sites | Oui |
| Filtrer les produits | L'administrateur peut filtrer les produits par sport, catégorie, marque,prix,mot-clé |Oui|
| Ajouter produit | L'Admin peut ajouter un produit avec ces images son nom, son genre, son sport, son type, sa marque, son prix et sa description | Oui |
| Supprimer un produit | L'admin peut supprimer n'importe quel produit | Oui |
| Supprimer des produits | L'admin peut supprimer plusieurs produit en même temps | Oui |
| Modifier un produit | L'admin peut modifier tout les détails d'un produits | Oui |
| L'admin peut consulter le stock d'un produits | Il peut consulter le stock par variant et par taille d'un produit | Oui |
| Réssuciter un produit | L'admin peut réssusiter un produit supprimer | Oui |
| Afficher utilisateurs | L'admin peut afficher tout les utilisateurs par tranche de 1,2,5,10,20,50,100,500,1000 | Oui |
| Consulter utilisateurs | L'admin peut consulter les information d'un utilisateurs | Oui |
| Réinitialiser mot de passe  | L'admin peut réinitialiser le mot de passe d'u utilisateurs | Oui |
| Modifer informations utilisateurs | L'admin peut modifier les informations personnelle d'un user | Oui |
| Modifier adresse utilisateurs | L'admin peut modifier les adresses d'un utilisateurs | Oui |
| Supprimer addresse utilisateurs | L'admin peut supprimer les adresses d'un utilisateurs | Oui |
| Ajouter adresse utilisateurs | L'admin peut ajouter une adresse à un utilisateurs | Oui |
| Consulter commandes utilisateurs | L'admin peut consulter les commandes d'un utilisateurs | Oui |
| Supprimer utilisateurs | L'admin peut supprimer un utilisteurs | Oui |
| Réssuciter utilisateurs | L'admin peut réssuciter un utilisateurs | Oui |
| Afficher commandes | L'admin peut afficher toutes les commandes passées sur le site | Oui |
| Filtrer commandes | L'admin peut rechercher une commandes par son numéros | Oui |
| Afficher commandes | L'admin peut afficher les détails d'une commandes | Oui |
| Changer statut commande | L'admin peut changer le statut d'une commande | Oui |
| Annuler commande | L'admin peut annuler une commandes | Oui |
| Afficher le stock | L'admin peut afficher le stock par sport par type de produit et par tranche de 1,2,5,10,20,50,100 produit par page | Oui |
| Consulter stock | Consulter le stock d'un produit en particulier | Oui |
| Ajouter référence | L'admin peut ajouter un variant à un produit | Oui |
| Chnager quantité référence | L'admin peut changer la quantité d'un référence en particulier | Oui |
| Supprimer une référence | L'admin peut supprimer une référence d'un produit | Oui |
| Supprimer des références | L'admin peut supprimer plusieurs référence en même temps | Oui |
|  |||


## Dao

| Fonctionnalité             |Description                                                                     | Est déployé ? |
|:-------------------- |:------------------------------------------------------------------------------- |:------------- |
| Importer des données | L'admin peut importer des données dans la base de données à partir de fichier YAML, XML, JSON, CSV sur chaque tables | Oui |
| Exporter des données | L'admin peut exporter des données de la base de données en YAML, XML, JSON, CSV. Il peut choisir la table et la colonne à exporter | Oui |
| Importer plusieurs fichiers | Importer plusieurs fichier d'un coup | Non |
| Exporter BD | Exporter toute la base de données d'un coup | Non |

## Info 

| Fonctionnalité             |Description                                                                     | Est déployé ? |
|:-------------------- |:------------------------------------------------------------------------------- |:------------- |
| Consulter Information | Consulter les informations légale à propos de casporama.live | Oui |
| Consulter CGV | Consulter les CGV du site | Oui |
| Contact | Le client peut nous envoyer un message sur le site | Oui |



Le client peut consulter 4 pages différentes pour les 4 sport différentes. Sur chaques pages il peut consulter 3 pages qui sont les 3 types de produit : Vetements, Chaussures, Equipements. Sur chacune de ces pages le client voit tous les produit correspondant. Il peut filtrer sa recherche par Marque par prix minimum et maximum ainsi que recherché des mot clés. Il peut cliquer sur un produit pour afficher ses détails. Il peut consulter les images secondaires du produit. Il peut choisir une couleur pour le produit ainsi qu'une taille parmis celle disponible. Il peut ensuite ajouter son produit au panier.


