<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Nuevo libro - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>
        
        <?= $template->header('Borrar libro') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Libros'=>'/Libro/list',
            'Crear libro' => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>
        
            <h2>Nuevo libro</h2>

            <form action="/Libro/store" enctype="multipart/form-data" method="POST">
                <div class="flex2">
                    <label>ISBN:</label>
                    <input type="text" name="isbn" value="<?= old('isbn')?>">
                    <br>
                    <label>Título:</label>
                    <input type="text" name="titulo" value="<?= old('titulo')?>">
                    <br>
                    <label>Editorial:</label>
                    <input type="text" name="editorial" value="<?= old('editorial')?>">
                    <br>
                    <label>Autor:</label>
                    <input type="text" name="autor" value="<?= old('autor')?>">
                    <br>
                    <label>Idioma:</label>
                    <select name="idioma">
                        <option value="Castellano" <?= oldSelected('idioma', 'Castellano')?>>Castellano</option>
                        <option value="Catalán" <?= oldSelected('idioma', 'Catalán')?>>Catalán</option>
                        <option value="Otros" <?= oldSelected('idioma', 'Otros')?>>Otros</option>
                    </select>
                    <br>
                    <label>Edición:</label>
                    <input type="text" name="edicion" value="<?= old('edicion')?>">
                    <br>
                    <label>Año:</label>
                    <input type="number" name="anyo" value="<?= old('anyo')?>">
                    <br>
                    <label>Edad Rec.:</label>
                    <input type="number" name="edadrecomendada" value="<?= old('edadrecomendada')?>">
                    <br>
                    <label>Páginas:</label>
                    <input type="number" name="paginas" value="<?= old('paginas')?>">
                    <br>
                    <label>Característias:</label>
                    <input type="text" name="caracteristicas" value="<?= old('caracteristicas')?>">
                    <br>
                    <label>Tema:</label>
                    <select name="idtema">
                    <?php foreach($listaTemas as $nuevoTema ){?>
                        <option value="<?= $nuevoTema->id ?>"><?= $nuevoTema->tema ?></option>
                    <?php } ?>
                    </select>
                    <br>
                    <label>Sinopsis:</label>
                    <textarea name="sinopsis" class="w50" ><?= old('sinopsis')?></textarea>
                    <br>
                </div>
                <div class="centered mt2">
                    <input type="submit" class="button" name="guardar" value="Guardar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atras</a>
                <a class="button" href="/libro/list">Lista de libros</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>