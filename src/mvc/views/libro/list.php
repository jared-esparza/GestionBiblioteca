<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lista de libros - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>

        <?= $template->header('Lista de libros') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs(['Libros'=>null]) ?>
        <?= $template->messages() ?>

        <main>

            <h2>Lista completa de libros</h2>
            <br>
            <?php
                echo $template->filter(
                    // opciones para el desplegable "buscar en"
                    [
                        'Título' => 'titulo',
                        'Editorial' => 'editorial',
                        'Autor' => 'autor',
                        'ISBN' => 'isbn'
                    ],
                    // opciones para el desplegable "ordenar por"
                    [
                        'Título' => 'titulo',
                        'Editorial' => 'editorial',
                        'Autor' => 'autor',
                        'ISBN' => 'isbn'
                    ],
                    'Tiítulo', // opción seleccionada por defecto en "buscar en"
                    'Tiítulo', // opción seleccionada por defecto en "ordenar por"
                    $filtro  // filtro aplicado (null si no hay) - viene del controlador
                );?>
            <div class="right">
                <?= $paginator->stats() ?>
            </div>
            <?php if($libros){ ?>
                <table class="table w100">
                    <tr>
                        <th>Portada</th>
                        <th>ISBN</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Ejemplares</th>
                        <th class="centrado">Operaciones</th>
                    </tr>
                <?php foreach($libros as $libro){ ?>
                    <tr>
                        <td class="centrado">
                            <a href="/Libro/show/<?= $libro->id ?>">
                                <img src="<?= BOOK_IMAGE_FOLDER . '/' .($libro->portada ?? DEFAULT_BOOK_IMAGE) ?>" class="table-image">
                            </a>
                        </td>
                        <td><?= $libro->isbn ?></td>
                        <td><?= $libro->titulo ?></td>
                        <td><?= $libro->autor ?></td>
                        <td><?= $libro->ejemplares ?></td>

                        <td class="centrado">
                           <a href="/Libro/show/<?= $libro->id ?>">Ver</a>
                           <a href="/Libro/edit/<?= $libro->id ?>">Editar</a>
                           <?php if(!$libro->ejemplares){ ?>
                                <a href="/Libro/delete/<?= $libro->id ?>">Borrar</a>
                           <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </table>
                <?= $paginator->ellipsisLinks() ?>
            <?php } else { ?>
                <div class="danger p2">
                    <p>No hay libros que mostrar</p>
                </div>
            <?php } ?>
            <div class="centered">
                 <a class="button-success flex1" href="/Libro/create">Nuevo libro</a>
                <a class="button" onclick="history.back()">Atrás</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>