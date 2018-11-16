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
            <div class="card">
                <div class="card-header">Ajout</div>
                <div class="card-body">
                    <form action="<?= route('admin'); ?>" method="post">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="editor">&Eacute;diteur</label>
                            <input type="text" class="form-control" name="editor" id="editor" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="release_date">Date de sortie</label>
                            <input type="text" class="form-control" name="release_date" id="release_date"
                                placeholder="">
                        </div>
                        <div class="form-group">
                        <label for="platform">Console / Support</label>
                        <select class="custom-select" id="platform_id" name="platform_id">
                            <option>-</option>
                            
                            <?php foreach($platforms as $platform): ?>
                                <option value="<?= $platform->id ?>"> 
                                    <?= $platform->name ?>
                                </option>
                            <?php endforeach;?>

                        </select>
                    </div>
                        <button type="submit" class="btn btn-success btn-block">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <!-- pour récupérer l'url de la route, on utilise son nom défini dans routes/web.php en valeur de la clé associative 'as' -->
            <a href="<?= route('home'); ?>" class="btn btn-primary d-block">Retour accueil</a>
        </div>
    </div>
</main>

<?= view('layout/footer')?>