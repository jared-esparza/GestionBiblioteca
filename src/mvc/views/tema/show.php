<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Detalles de tema - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>
        
        <?= $template->header('Detalles de tema') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Temas'=>'/Tema/list',
            'Detalles de tema ' . $tema->tema => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>
            <section>
                <p><b>Tema:</b> <?= $tema->tema ?></p>
                <p><b>Descripcion:</b> <?= $tema->descripcion ?></p>

                <h2>Lista de libros</h2>
                <table class="table w100">
                    <tr>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                    </tr>
                <?php
                    $libros = $tema->belongsToMany('Libro', 'temas_libros');
                    foreach($libros as $libro){?>
                    <tr>
                        <td>
                            <a href="/Libro/show/<?=$libro->id?>">
                                <?=$libro->titulo?>
                            </a>
                        </td>
                        <td><?=$libro->autor?></td>
                        <td><?=$libro->editorial?></td>
                    </tr>
                    <?php } ?>
                </table>
            </section>
            <div class="centrado">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/Tema/list">Lista de temas</a>
                <a class="button" href="/Tema/edit/<?=$tema->id?>">Editar</a>
                <a class="button" href="/Tema/delete/<?=$tema->id?>">Eliminar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>