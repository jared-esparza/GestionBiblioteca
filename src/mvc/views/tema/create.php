<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Nuevo tema - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>

        <?= $template->header('Nuevo tema') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Temas'=>'/Tema/list',
            'Nuevo tema' => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>

            <h2>Nuevo tema</h2>

            <form action="/Tema/store" enctype="multipart/form-data" method="POST">
                <div class="flex2">
                    <label>Tema:</label>
                    <input type="text" name="tema" value="<?= old('tema')?>">
                    <br>
                    <label>Descripción:</label>
                    <input type="text" name="descripcion" value="<?= old('descripcion')?>">
                </div>
                <div class="centered mt2">
                    <input type="submit" class="button" name="guardar" value="Guardar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atras</a>
                <a class="button" href="/tema/list">Lista de temas</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>