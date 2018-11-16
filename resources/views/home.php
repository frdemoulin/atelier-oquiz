<?= view('layout/header')?>

<main class="container">
    <div class="jumbotron">
        <h1 class="display-4">Mes jeux vidéo</h1>
        <p class="lead">Voici une petite interface toute simple (grâce à bootstrap) permettant de visualiser les
            jeux vidéo de ma base de données, mais aussi de les ajouter !</p>
    </div>
    <h1></h1>
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">

            <!-- 
            Bonne pratique : préférer le passage des paramètres d'une route via le tableau et non en dur
            ex : route('monNomDeRoute', ['maVariable' => 'maValeur'])
            -->

            <a href="<?= route('home', ['name' => 'name']); ?>" class="btn btn-primary">Trier par nom</a>&nbsp;
            <a href="<?= route('home', ['order' => 'editor']); ?>" class="btn btn-info">Trier par éditeur</a>&nbsp;
            <!-- TODO (optionnel) n'afficher ce bouton que s'il y a un tri -->
            <a href="<?= route('home'); ?>" class="btn btn-dark">Annuler le tri</a><br>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">&Eacute;diteur</th>
                        <th scope="col">Date de sortie</th>
                        <th scope="col">Console / Support</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- TODO boucler sur le tableau $videogameList contenant tous les jeux vidéos
                (et donc supprimer ces 2 lignes d'exemple) -->
                    <tr>
                        <td>-</td>
                        <td>Exemple</td>
                        <td>à faire</td>
                        <td>depuis</td>
                        <td>la DB</td>
                    </tr>
                    <?php foreach($videoGameList as $videoGame): ?>
                        <tr>
                            <td><?= $videoGame->id ?></td>
                            <td><?= $videoGame->name ?></td>
                            <td><?= $videoGame->editor ?></td>
                            <td><?= $videoGame->release_date ?></td>
                            <td><?= $videoGame->platform_id ?></td>
                        </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <a href="<?= route('admin'); ?>" class="btn btn-primary d-block">admin</a>
        </div>
    </div>
</main>

<?= view('layout/footer')?>