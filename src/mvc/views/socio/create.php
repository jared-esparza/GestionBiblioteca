<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Nuevo socio - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>

        <?= $template->header('Nuevo socio') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Socios'=>'/Socios/list',
            'Nuevo socio' => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>

            <h2>Nuevo socio</h2>

            <form action="/Socio/store" enctype="multipart/form-data" method="POST">
                <div class="flex2">
                    <label>DNI:</label>
                    <input type="text" name="dni" value="<?= old('dni')?>">
                    <br>
                    <label>Nombre:</label>
                    <input type="text" name="nombre" value="<?= old('nombre')?>">
                    <br>
                    <label>Apellidos:</label>
                    <input type="text" name="apellidos" value="<?= old('apellidos')?>">
                    <br>
                    <label>Nacimiento:</label>
                    <input type="date" name="nacimiento" value="<?= old('nacimiento')?>">
                    <br>
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= old('email')?>">
                    <br>
                    <label>Dirección:</label>
                    <input type="text" name="direccion" value="<?= old('direccion')?>">
                    <br>
                    <label>CP:</label>
                    <input type="text" name="cp" value="<?= old('cp')?>">
                    <br>
                    <label>Población:</label>
                    <input type="text" name="poblacion" value="<?= old('poblacion')?>">
                    <br>
                    <label>Provincia:</label>
                    <input type="text" name="provincia" value="<?= old('provincia')?>">
                    <br>
                    <label>Telefono:</label>
                    <input type="text" name="telefono" value="<?= old('telefono')?>">
                </div>
                <div class="centered mt2">
                    <input type="submit" class="button" name="guardar" value="Guardar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atras</a>
                <a class="button" href="/socio/list">Lista de socios</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>