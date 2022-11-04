<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/
$autoload['packages'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in system/libraries/ or your
| application/libraries/ directory, with the addition of the
| 'database' library, which is somewhat of a special case.
|
| Prototype:
|
|    $autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|    $autoload['libraries'] = array('user_agent' => 'ua');
*/
/*
    * Dev :
    *   J'ajoute la librairie 'database' pour pouvoir utiliser la base de données
    *   J'ajoute la librairie 'session' pour pouvoir utiliser les sessions
    *   J'ajoute la librairie 'form_validation' pour pouvoir utiliser la validation des formulaires
    *   J'ajoute la librairie 'email' pour pouvoir envoyer des emails
    *   J'ajoute la librairie 'upload' pour pouvoir uploader des fichiers
    *   J'ajoute la librairie 'encryption' pour pouvoir crypter des données

*/
$autoload['libraries'] = array('database', 'session', 'form_validation', 'encryption', 'email', 'upload');

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in system/libraries/ or in your
| application/libraries/ directory, but are also placed inside their
| own subdirectory and they extend the CI_Driver_Library class. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|    $autoload['drivers'] = array('cache');
|
| You can also supply an alternative property name to be assigned in
| the controller:
|
|    $autoload['drivers'] = array('cache' => 'cch');
|
*/
$autoload['drivers'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|    $autoload['helper'] = array('url', 'file');
*/
/*

 * Dev:
 *  J'ajoute le helper url pour pouvoir utiliser les fonctions de redirection et de base_url
 *  J'ajoute le helper form pour pouvoir utiliser les fonctions de création de formulaire
 *  J'ajoute le helper cookie pour pouvoir utiliser les fonctions de gestion des cookies
 *  J'ajoute le helper file pour pouvoir utiliser les fonctions de gestion des fichiers
 *  J'ajoute le helper html pour pouvoir utiliser les fonctions de création d'éléments html

*/

$autoload['helper'] = array('url', 'form', 'cookie', 'file', 'html');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|    $autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|    $autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|    $autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|    $autoload['model'] = array('first_model' => 'first');
*/
/*

    * Dev:
    *  J'ajoute le model LoaderView pour pouvoir utiliser la fonction load de ce model qui permet de charger les pages
    *  via les données stocké dans le fichier Yaml permettant de gérer les pages du site web de manière dynamique
    *  et simple, cela permet au développeur Frontend de pouvoir modifier les pages sans avoir à toucher au code
    *  du site web cela réduit donc les risques de bugs et permet de gagner du temps.
    *  J'ajoute le model UtilView pour pouvoir utiliser la fonction generateLoadView qui permet
    *  de générer le code html de la page de manière dynamique et simple, cela permet au développeur Frontend
    *  de pouvoir modifier les pages en touchant très peut au code, cette fonction est néccesaire car
    *  elle s'adapte au lien personalisé de la page et permet de charger les données de la page.

*/
$autoload['model'] = array('UserModel','utilities/UtilView', 'utilities/LoaderView');
