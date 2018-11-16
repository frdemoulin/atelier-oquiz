<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * howto : Création d'une route
 * 
 * $router->nomDeLaMethode('url', 'fonctionouController');
 * 
 * ex : $router->get('url', function () use ($router)));
 */

 /*

// 1 route avec texte en dur
$router->get('/', function () use ($router) {
    // on peut retourner du html à partir d'une fonction anonyme (mauvaise pratique)
    // concrètement, le système de routing est un énorme tableau associatif
    // 'url' => code à exécuter
    return '<h1>Hello toto !</h1>';
});
*/

// 2 route avec texte en html
/*
$router->get('/toto-route', function () use ($router) {
    // on peut aussi retourner du html pour tester le fonctionnement d'une route classique sans controller
    return '<h1>Hello toto !</h1>';
});
*/

// 3 utilisation de view dans le routing + passage de param
/*
$router->get('/toto-route', function () use ($router) {
    // la fonction vue est disponible à différente endroits de mon application dont le routing (pas bonne pratqiue) mais surtout les controllers
    // la fonction view va automatiquement aller chercher dans le dossier prévu à cet effet soit /resources/views pour aller chercher le nom de fichier
    // on ne précise pas l'extension de la vue, ie .php
    // le 2e paramètre comprendra les paramètres à passer à la vue sous forme de tableau associatif
    return view('mavuetoto', [
        'name' => 'SuperNom'
    ]);
});
*/

// 4 une route dans les règles de l'art : association url + controller et associée à un nom
$router->get('/toto-route', [
    'as' => 'toto', // clef = nom de la route => valeur = url
    'uses' => 'MainController@showToto' // le code qui doit être exécuté et qui se situe dans MainController@laMethode à appeler. C'est Lumen qui se charge de découper MainController@laMethode sur le arobase (# avec AltoRouter)
]);

// route en get associée à la page admin
$router->get('/admin', [
    'as' => 'admin', // clef = as => valeur = url
    'uses' => 'MainController@admin' // le code qui doit être exécuté et qui se situe dans MainController@laMethode à appeler. C'est Lumen qui se charge de découper MainController@laMethode sur le arobase (# avec AltoRouter)
]);

/*
 Je peux definir la meme route avec les meme parametres en changeant la methode afin qu'elle soit acceptée dans le routing.

 En revanche, elles ne se telescoperont pas parce que le simple fait qu'elles soient appliquées sur des methodes différentes (get,post etc) les rend uniques
*/

// route en post associée à la page admin
$router->post('/admin', [
    'as' => 'admin', // clef = as => valeur = nom de la route
    // cette valeur est à mettre dans la méthode route() afin de 
    'uses' => 'MainController@adminPost' // le code qui doit être exécuté et qui se situe dans MainController@laMethode à appeler. C'est Lumen qui se charge de découper MainController@laMethode sur le arobase (# avec AltoRouter)
]);

// route associée à la page home
$router->get('/', [
    'as' => 'home',
    'uses' => 'MainController@home'
]);