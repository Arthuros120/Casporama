
# Les étapes a suivre pour installer le projet

## 1. Installation de l’environnement

### 1.1.* Prérequis

'''bash

sudo apt-get update && sudo apt-get upgrade
sudo apt install software-properties-common

'''

### 1.1. Installation de Apache2

'''bash

sudo apt-get install apache2 apache2-doc apache2-utils libexpat1 ssl-cert
sudo apt install ca-certificates apt-transport-https software-properties-common

'''

### 1.2. Installation de PHP

'''bash

sudo apt-get install php libapache2-mod-php

'''

Redemarrer le serveur apache

'''bash

sudo systemctl restart apache2

'''

### 1.3. Installation de MariaDB

'''bash

sudo apt-get install mariadb-server mariadb-client

'''

## 2 Installation de l’application

### 2.1. Téléchargement de l’application

'''bash

git clone git@gitlab.univ-nantes.fr:pub/but/but2/r3.01/sae/equipe1-1.git

'''

### 2.2. Transfert des fichiers

'''bash

sudo cp -r equipe1-1/* /var/www/html/

'''

### 2.3 Attribution des droits

'''bash

sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 777 /var/www/html/

'''

### 2.4 Installation des extensions PHP

'''bash

sudo apt-get install php-mysql php-yaml php-gd php-xml php-mbstring php-zip php-curl php-cli php-json php-common

'''

### 2.5 Configuration d'Apache 2

#### 2.5.1. Configuration du fichier de configuration

'''bash

sudo nano /etc/apache2/apache2.conf

'''

Voici ma configuration :

src/apache2.conf: # Configuration de Apache2

#### 2.5.2. Configuration du fichier de virtualhost

'''bash

sudo nano /etc/apache2/sites-available/000-default.conf

'''

Voici ma configuration :

src/000-default.conf: # Configuration de virtualhost

#### 2.5.3. Activation du module rewrite

'''bash

sudo a2enmod rewrite

'''

#### 2.5.4. Redémarrage du serveur

'''bash

sudo systemctl restart apache2

'''

### 2.6. Installation de l'application

'''bash

cp src/.htaccess Casporama/

'''

### 2.7. Configuration de l'application

Modifier le fichier Casporama/.htaccess pour y mettre les informations de connexion à la base de données et vos informations de connexion à l'application.
