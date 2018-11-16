<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
 Pour chaque table de ma BDD = 1 model. 
 Je dois creer mes model à la racine du dossier app. 
 Il existe deja un model dédiés aux utilisateurs qui peux nous servir d'exemple
*/

Class Platform extends Model {

    /*
     Pour que je sache a quelle table ma class Model doit faire reference je peux lui indiquer
     explicitement avec la propriété $table
    */

    // By convention, the "snake case", plural name of the class will be used as the table name unless another name is explicitly specified
    protected $table = 'platform';

    // on désactive le timestamp vis-à-vis des champs created_at et updated_at
    public $timestamps = false;
}
