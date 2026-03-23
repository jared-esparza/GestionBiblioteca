<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Editar tema - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>
        
        <?= $template->header('Editar Tema') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Temas'=>'/Tema/list',
            'Editar tema ' . $tema->tema => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>
        
            <h2>Editar el tema <?= $tema->nombre ?></h2>

            <form action="/Tema/update" enctype="multipart/form-data" method="POST">
                <div class="flex2">
                    <input type="hidden" value="<?= $tema->id ?>" name="id">
                    <label>Tema:</label>
                    <input type="text" name="tema" value="<?= old('tema', $tema->tema)?>">
                    <br>
                    <label>Descripción:</label>
                    <input type="text" name="descripcion" value="<?= old('descripcion', $tema->descripcion)?>">
                </div>
                <div class="centered mt2">
                    <input type="submit" class="button" name="actualizar" value="Actualizar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/tema/list">Lista de temas</a>
                <a class="button" href="/tema/show/<?= $tema->id ?>">Detalles</a>
                <a class="button" href="/tema/delete/<?= $tema->id ?>">Borrar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>