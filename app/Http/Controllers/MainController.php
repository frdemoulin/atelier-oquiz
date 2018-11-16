<?php

// on déclare le namespace
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

//import de mon model pour effectuer des requetes
use App\Videogame;
use App\Platform;

/*
 Pour utiliser / recuperer l'objet Request, on doit obligatoirement importer cette classe Lumen
*/

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * L'objet Request est un objet spécial de chez Lumen, si je type hint la variable $request avec la classe Request de chez Lumen, le fwk sera capable de remplir cet objet avec les données HTTP envoyées
     * De ce fait, Request permet d'éviter de tester si on est en $_GET ou en $_POST : il acheminera les datas au bon endroit dans son objet
     */

    // on crée la méthode associée au controller défini dans le routing
    public function showToto(Request $request)
    {
        //dump($request);
        // on récupère la data chiffre passée en GET ?chiffre=...
        //elle se retrouve dans $request à la clé query, on trouve :
        // 'chiffre' => valeur
        $chiffre = $request->input('chiffre');
        // on récupère une data avec la fonction $request->input('nomdemonparametre')
        // l'index input se voit dans le champ query du dump
        if ($chiffre == 51)
        {
            // la fonction response()->json() est équivalente au json_encode
            // lorsque l'on arrive à ce stade, on renvoie directement la donnée sans afficher la vue

            // l'objet response pour avoir plusieurs utilités
            // on retourne dans ce cas du json mais rien n'empêche de renvoyer un autre format, un autre status code (401 par ex) ou encore modifier les headers
            // pour plus de précisions : https://lumen.laravel.com/docs/5.4/responses
            return response()->json([
                'name' => 'Pastis'
            ]);
        }

        return view('mavuetoto', [
            'name' => 'SuperNom',
            'chiffre' => $chiffre
        ]);
    }

    // méthode en get associée à la route /admin
    public function admin()
    {
        // on récupère les infos des plateformes en bdd
        $platformList = Platform::all();

        // on retourne ces infos à la clé 'platforms'
        return view('admin', [
            'platforms' => $platformList
        ]);
    }

    // méthode en post associée à la route /
    public function adminPost(Request $request)
    {
        /*
         Pour recuperer les données passées en GET  ou en post 
         il faut utiliser la methode commune $request->input('monParam');
        */

        // on peut utiliser une valeur en 2e paramètre qui sera retournée par défaut si l'input côté form est envoyé à vide
        $name = $request->input('name', '');
        $editor = $request->input('editor', '');
        $release = $request->input('release_date', '');
        $platformId = $request->input('platform_id', '');

        /*
         Pour inserer en DB
         - je dois d'abord creer un objet du modèle souhaité à vide
         - je dois remplir ses champs
         - je dois sauvegarder
         doc : https://laravel.com/docs/5.7/queries#inserts
        */

        $videogame = new Videogame();

        $videogame->name = $name;
        $videogame->editor = $editor;
        $videogame->release_date = $release;
        $videogame->platform_id = $platformId;
        //la methode save tout comme la methode all existe deja chez mon model
        $videogame->save();

        //@todo enregistrer les donnée dans la base de donnée pour les persister

        // //return view('admin');
        // // on ne fait que tester pour l'instant
        // echo '<h3>$name</h3>';
        // var_dump($name);
        // echo '<h3>$editor</h3>';
        // var_dump($editor);
        // echo '<h3>$release_date</h3>';
        // var_dump($release_date);
        // echo '<h3>$platform</h3>';
        // var_dump($platform);

        // pas de view dans le return car le but de cette page n'est pas d'afficher une vue mais d'enregistrer des résultats en bdd
        // on redirige vers la page admin une fois les datas saved en bdd
        /*
         Dans mon cas adminPost enregistre et admin affiche les données.
         La pratique courante est de rediriger vers la methode qui permettra l'affichage des données.
         De ce fait je vais effectuer une redirection mais en plus sur le nom de la route concernée.
         Cela me permmetra si je change l'url dans les route de ne pas etre impacté.
        
        route('NomDeMaRoute') va aller verifier dans le fichier ou sont definies mes routes (web.php) quelle route a le nom admin (dans notre cas)

        Ce nom de route est present dans la definition d'une route au parametre "as".
        Une fois trouvée il arrive automatiquement a detecter qu'elle est l'url associée sur laquelle rediriger
        */
        return redirect()->route('admin');

    }

    // méthode associée à la route /
    public function home(Request $request)
    {
        /*
         Pour effectuer une requete raw classique il faut que j'utilise l'objet DB.
         Je dois donc faire un use Illuminate\Support\Facades\DB.

         Puis a partir de l'objet DB appeler la methode select afin d'effectuer ma requete directement dedans
        */

        //la methode select ne fait que lire des données , en revanche il existe d'autre methode pour effectuer d'autres actions du type insert, delete etc...
        //$videoGameList = DB::select("SELECT * FROM videogame"); 
        
        /*
         Grace au model que j'ai créé à la racine du dossier app, je peux desormais m'epargner une requete direct et assez commune : retourner tout les objet de tel ou tel table.

         Pour que cela fonctionne je dois appeler en amont de mon controller mon model sur lequel je souhaite retourner un ou plusieurs elements et effectuer un appel (dans le cas je je veux retourner tout les element) un ::al() qui effectuera le meme genre de requete fait precedemment avec DB::select
        */
        // https://laravel.com/docs/5.7/queries
        // version détaillée : $videoGameList = DB::select("SELECT * FROM videogame");
        // Videogame correspond au nom de la classe
        $videoGameList = Videogame::all();
        dump($videoGameList);
        
        // pour récupérer une donnée passée en paramètre, il faut utiliser la méthode input de l'objet Request
        $order = $request->input('order');
        //dump($order);

        //ce qui compte pour que la view puisse creer une variable exploitable c'est la clef associative associé a la variable a passer coté controller
        return view('home', [
            'videoGameList' => $videoGameList
        ]);
    }
}
