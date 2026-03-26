<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Borrar prestamo - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>

        <?= $template->header('Borrar prestamo') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Prestamos'=>'/Prestamo/list',
            'Borrado ' . $prestamo->titulo => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>

            <h2>Borrar prestamo</h2>

            <form action="/Prestamo/destroy" enctype="multipart/form-data" method="POST" class="p2 m2">
                <p>Confirmar el borrado del prestamo<?= $prestamo->id ?></p>
                <input type="hidden" name="id" value="<?= $prestamo->id ?>">
                <input type="submit" class="button-danger" name="borrar" value="Borrar">
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/prestamo/list">Lista de prestamos</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>