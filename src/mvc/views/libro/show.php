<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Detalles de libros - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
        <script src="/js/Modal.js"></script>

    </head>
    <body>

        <?= $template->header('Detalle de ' . $libro->titulo) ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Libros'=>'/Libro/list',
            'Detalles de ' . $libro->titulo => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <section class="flex-container gap2" id="detalles">
                <div class="flex2">
                    <h2><?= $libro->titulo?></h2>
                    <p><b>ISBN:</b> <?= $libro->isbn?></p>
                    <p><b>Titulo:</b> <?= $libro->titulo?></p>
                    <p><b>Editorial:</b> <?= $libro->editorial?></p>
                    <p><b>Autor:</b> <?= $libro->autor?></p>
                    <p><b>Idioma:</b> <?= $libro->idioma?></p>
                    <p><b>Edición:</b> <?= $libro->edicion?></p>
                    <p><b>Edad recomendada:</b> <?= $libro->edadrecomendada ?? ' -- '?></p>
                    <p><b>Páginas:</b> <?= $libro->paginas ?? ' -- '?></p>
                    <p><b>Características:</b> <?= $libro->caracteristicas ?? ' -- '?></p>
                </div>
                <figure class="flex1 centrado p2">
                    <img src="<?= BOOK_IMAGE_FOLDER . '/' .($libro->portada ?? DEFAULT_BOOK_IMAGE) ?>" class="cover with-modal">
                    <figcaption>Portada de <?= "$libro->titulo, de $libro->autor" ?></figcaption>
                </figure>
            </section>
            <section>
                <h2>Sinopsis</h2>
                <p><?= $libro->sinopsis ? toHTML($libro->sinopsis) : 'Sin detalles' ?></p>
            </section>
            <section>
                <h2>Ejemplares de este libro</h2>
                <a class="button" href="/Ejemplar/create/<?= $libro->id ?>">Nuevo ejemplar</a>
                <div class="grid-list">
                    <div class="grid-list-header">
                        <span>ID</span>
                        <span>Estado</span>
                        <span>Precio</span>
                    </div>
            <?php
                foreach($ejemplares as $ejemplar){?>
                    <div class="grid-list-item">
                        <span data-label="ID"><?=$ejemplar->id?></span>
                        <span data-label="Estado"><?=$ejemplar->estado?></span>
                        <span data-label="Precio"><?=$ejemplar->precio . ' €'?></span>
                    </div>
            <?php } ?>
            </div>
        </section>
        <section>
            <h2>Temas de este libro</h2>
            <div class="grid-list">
                <div class="grid-list-header">
                    <span>ID</span>
                    <span>Tema</span>
                </div>
            <?php

                foreach($temas as $tema){?>
                <div class="grid-list-item">
                    <span data-label="ID"><?=$tema->id?></span>
                    <span data-label="Tema">
                        <a href="/Tema/show/<?=$tema->id?>">
                            <?=$tema->tema?>
                        </a>
                    </span>
                </div>
                <?php } ?>
            </div>
        </section>
            <div class="centrado">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/Libro/list">Lista de libros</a>
                <a class="button" href="/Libro/edit/<?=$libro->id?>">Editar</a>
                <a class="button" href="/Libro/delete/<?=$libro->id?>">Eliminar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>