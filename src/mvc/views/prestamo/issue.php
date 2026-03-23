<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Incidencia prestamo - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>
        
        <?= $template->header('Incidencia Prestamo') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Prestamos'=>'/Prestamo/list',
            'Incidencia prestamo ' . $prestamo->id => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>
        
            <h2>Añadir incidencia al prestamo <?= $prestamo->id ?></h2>

            <form action="/Prestamo/update" enctype="multipart/form-data" method="POST">
                <div class="flex2">
                    <input type="hidden" value="<?= $prestamo->id ?>" name="id">
                    <label>Incidencia:</label>
                    <input type="text" name="incidencia" value="<?= old('incidencia', $prestamo->incidencia)?>">
                </div>
                <div class="centered mt2">
                    <input type="submit" class="button" name="actualizar" value="Actualizar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/prestamo/list">Lista de prestamos</a>
                <a class="button" href="/prestamo/delete/<?= $prestamo->id ?>">Borrar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>