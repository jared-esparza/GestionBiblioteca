<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Detalles de libros - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
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
            <h1><?= APP_NAME?></h1>
            <section>
            <h2><?= $libro->titulo?></h2>
            <p><b>ISBN:</b> <?= $libro->isbn?></p>
            <p><b>Titulo:</b> <?= $libro->titulo?></p>
            <p><b>Editorial:</b> <?= $libro->editorial?></p>
            <p><b>Autor:</b> <?= $libro->autor?></p>
            <p><b>Idioma:</b> <?= $libro->idioma?></p>
            <p><b>Edición:</b> <?= $libro->edicion?></p>
            <p><b>Edad recomendada:</b> <?= $libro->edadrecomendada ?? ' -- '?></p>
            <p><b>Páginas:</b> <?= $libro->paginas ?? ' -- '?></p>
            <p><b>Características:</b> <?= $libro->caracterisitcas ?? ' -- '?></p>
            </section>
            <section>
                <h2>Sinopsis</h2>
                <p><?= $libro->sinopsis ? toHTML($libro->sinopsis) : 'Sin detalles' ?></p>
            </section>
            <section>
                <h2>Ejemplares de este libro</h2>
                <a class="button" href="/Ejemplar/create/<?= $libro->id ?>">Nuevo ejemplar</a>
                <table class="table w100">
                <tr>
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Precio</th>
                </tr>
            <?php
                foreach($ejemplares as $ejemplar){?>
                    <tr>
                        <td><?=$ejemplar->id?></td>
                        <td><?=$ejemplar->estado?></td>
                        <td><?=$ejemplar->precio . ' €'?></td>
                    </tr>
            <?php } ?>
            </table>
        </section>
        <section>
            <h2>Temas de este libro</h2>
            <table class="table w100">
                <tr>
                    <th>ID</th>
                    <th>Tema</th>
                </tr>
            <?php
                
                foreach($temas as $tema){?>
                <tr>
                    <td><?=$tema->id?></td>
                    <td>
                        <a href="/Tema/show/<?=$tema->id?>">
                            <?=$tema->tema?>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
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