<?= view('layout/header')?>

<!-- le nom a été passé à la vue dans la clé name en params -->
<h1>Bonjour <?= $name ?></h1>

<p>Le chiffre passé en param est <?= $chiffre; ?> </p>

<hr>

<!-- Pour afficher une url à partir de son nom défini dans le routing et la propriété as (ici la route s'appelle toto), route('toto') -->

<a href="/">
    Lien de la page vers toto
</a>

<?= view('layout/footer')?>