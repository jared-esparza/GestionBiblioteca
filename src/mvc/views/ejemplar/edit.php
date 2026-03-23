<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Editar ejemplar - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>
        
        <?= $template->header('Editar Ejemplar') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Ejemplares'=>'/Ejemplar/list',
            'Editar ejemplar ' . $ejemplar->id => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>
        
            <h2>Editar el ejemplar <?= $ejemplar->nombre ?></h2>

            <form action="/Ejemplar/update" enctype="multipart/form-data" method="POST">
                <div class="flex2">
                    <input type="hidden" value="<?= $ejemplar->id ?>" name="id">
                    <label>ID Libro:</label>
                    <input type="text" name="idlibro" value="<?= old('idlibro', $ejemplar->idlibro)?>">
                    <br>
                    <label>Año:</label>
                    <input type="text" name="anyo" value="<?= old('anyo', $ejemplar->anyo)?>">
                    <br>
                    <label>Precio:</label>
                    <input type="number" name="precio" value="<?= old('precio', $ejemplar->precio)?>">
                    <br>
                     <label>Estado:</label>
                    <input type="text" name="estado" value="<?= old('estado', $ejemplar->estado)?>">
                </div>
                <div class="centered mt2">
                    <input type="submit" class="button" name="actualizar" value="Actualizar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/Libro/edit/<?= $ejemplar->idlibro ?>">Cancelar edicion</a>
                <a class="button" href="/ejemplar/delete/<?= $ejemplar->id ?>">Borrar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>