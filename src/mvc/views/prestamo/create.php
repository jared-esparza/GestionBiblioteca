<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Nuevo prestamo - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>

        <?= $template->header('Nuevo prestamo') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Prestamos'=>'/Prestamo/list',
            'Nuevo prestamo' => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>

            <h2>Nuevo prestamo</h2>

            <form action="/Prestamo/store" enctype="multipart/form-data" method="POST">
                <div class="flex2">
                    <label>ID Ejemplar:</label>
                    <input type="text" name="idejemplar" value="<?= old('idejemplar')?>">
                    <br>
                    <label>ID Socio:</label>
                    <input type="text" name="idsocio" value="<?= old('idsocio')?>">
                    <br>
                    <label>Limite:</label>
                    <input type="date" name="limite" value="<?= old('limite')?>">
                    <br>
                </div>
                <div class="centered mt2">
                    <input type="submit" class="button" name="guardar" value="Guardar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atras</a>
                <a class="button" href="/prestamo/list">Lista de prestamos</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>