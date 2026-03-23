<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Borrar tema - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>
        
        <?= $template->header('Borrar tema') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Temas'=>'/Tema/list',
            'Borrar tema ' . $tema->tema => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>
        
            <h2>Borrar tema</h2>

            <form action="/Socio/destroy" enctype="multipart/form-data" method="POST" class="p2 m2">
                <p>Confirmar el borrado del tema<?= $tema->tema ?></p>
                <input type="hidden" name="id" value="<?= $tema->id ?>">
                <input type="submit" class="button-danger" name="borrar" value="Borrar">
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/tema/list">Lista de temas</a>
                <a class="button" href="/tema/show/<?= $tema->id ?>">Detalles</a>
                <a class="button" href="/tema/edit/<?= $tema->id ?>">Editar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>