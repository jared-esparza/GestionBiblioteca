<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Nuevo ejemplar - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>

        <?= $template->header('Borrar ejemplar') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Ejemplares'=>'/Ejemplar/list',
            'Crear ejemplar' => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>

            <h2>Nuevo ejemplar</h2>

            <form action="/Ejemplar/store" enctype="multipart/form-data" method="POST">
                <div class="flex2">
                    <input type="hidden" name="idlibro" value="<?= $libro->id ?>">
                    <label>Año:</label>
                    <input type="anyo" name="anyo" value="<?= old('anyo')?>">
                    <br>
                    <label>Precio:</label>
                    <input type="number" name="precio" value="<?= old('precio')?>">
                    <br>
                    <label>Estado:</label>
                    <input type="text" name="estado" value="<?= old('estado')?>">
                </div>
                <div class="centered mt2">
                    <input type="submit" class="button" name="guardar" value="Guardar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atras</a>
                <a class="button" href="/ejemplar/list">Lista de ejemplares</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>