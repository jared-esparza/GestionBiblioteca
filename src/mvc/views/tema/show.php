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
                <div class="grid-list">
                    <div class="grid-list-header">
                        <span>Título</span>
                        <span>Autor</span>
                        <span>Editorial</span>
                    </div>
                <?php
                    $libros = $tema->belongsToMany('Libro', 'temas_libros');
                    foreach($libros as $libro){?>
                    <div class="grid-list-item">
                        <span data-label="Título">
                            <a href="/Libro/show/<?=$libro->id?>">
                                <?=$libro->titulo?>
                            </a>
                        </span>
                        <span data-label="Autor"><?=$libro->autor?></span>
                        <span data-label="Editorial"><?=$libro->editorial?></span>
                    </div>
                    <?php } ?>
                </div>
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