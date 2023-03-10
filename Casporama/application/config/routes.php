<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
*/

// * Donne la route par défaut qui est dans notre cas le controller "home"
$route['default_controller'] = 'home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

/*

    TODO: A completer avec les routes de l'application qui sont accesisble par l'utilisateur
    TODO: mais non voulu (function du controller en public mais qui ne peuvent pas être mis en privé)

*/

/*

    * Dev :
    *   Permet de rendre inaccesible les fonction qui doivent être privé dans le controleur
    *   mais qui ne peuvent pas être mis en privé (public function) car elles sont appelé par d'autre fonction.

*/

$route['User/CheckTheLogin(:any)'] = 'Error404';
$route['User/IsUniqueLogin(:any)'] = 'Error404';
$route['User/IsUniqueEmail(:any)'] = 'Error404';
$route['User/IsUniqueMobilePhone(:any)'] = 'Error404';
$route['User/ComformPassword(:any)'] = 'Error404';
$route['User/create_captcha(:any)'] = 'Error404';
$route['User/checkCaptcha(:any)'] = 'Error404';
$route['User/IsUniqueAddressName(:any)'] = 'Error404';
$route['Admin/InListCountry(:any)'] = 'Error404';
$route['Admin/InListDepartment(:any)'] = 'Error404';
$route['Admin/IsUniqueAddressName(:any)'] = 'Error404';
$route['Admin/IsUniqueEmail(:any)'] = 'Error404';
$route['Admin/IsUniqueMobilePhone(:any)'] = 'Error404';
$route['Admin/checkNameProduct(:any)'] = 'Error404';
$route['Admin/checkNameProductWithoutSelf(:any)'] = 'Error404';
$route['Admin/checkSport(:any)'] = 'Error404';
$route['Admin/checkType(:any)'] = 'Error404';

// !Api route

//$route['api/v1/Location/AllCountry']  = 'api/v1/Location/getAllCountry';
