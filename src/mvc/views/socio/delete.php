<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Borrar socio - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>
        
        <?= $template->header('Lista de socios') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Socios'=>'/Socio/list',
            'Borrado ' . $socio->nombre => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>
        
            <h2>Borrar socio</h2>

            <form action="/Socio/destroy" enctype="multipart/form-data" method="POST" class="p2 m2">
                <p>Confirmar el borrado del socio<?= $socio->nombre . ' ' . $socio->apellidos . ' ' . $socio->dni ?></p>
                <input type="hidden" name="id" value="<?= $socio->id ?>">
                <input type="submit" class="button-danger" name="borrar" value="Borrar">
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/socio/list">Lista de socios</a>
                <a class="button" href="/socio/show/<?= $socio->id ?>">Detalles</a>
                <a class="button" href="/socio/edit/<?= $socio->id ?>">Editar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>