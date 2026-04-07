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
                <div class="grid-list">
                    <div class="grid-list-header">
                        <span>Portada</span>
                        <span>ISBN</span>
                        <span>Titulo</span>
                        <span>Autor</span>
                        <span>Ejemplares</span>
                        <span class="centrado">Operaciones</span>
                    </div>
                <?php foreach($libros as $libro){ ?>
                    <div class="grid-list-item">
                        <span data-label="Portada" class="centrado">
                            <a href="/Libro/show/<?= $libro->id ?>">
                                <img src="<?= BOOK_IMAGE_FOLDER . '/' .($libro->portada ?? DEFAULT_BOOK_IMAGE) ?>" class="table-image">
                            </a>
                        </span>
                        <span data-label="ISBN"><?= $libro->isbn ?></span>
                        <span data-label="Título"><?= $libro->titulo ?></span>
                        <span data-label="Autor"><?= $libro->autor ?></span>
                        <span data-label="Ejemplares"><?= $libro->ejemplares ?></span>

                        <span data-label="Operaciones" class="centrado">
                           <a href="/Libro/show/<?= $libro->id ?>">Ver</a>
                           <?php if(Login::oneRole(LIBRARIAN_PANEL_ROLES)){ ?>
                           <a href="/Libro/edit/<?= $libro->id ?>">Editar</a>
                           <?php if(!$libro->ejemplares){ ?>
                                <a href="/Libro/delete/<?= $libro->id ?>">Borrar</a>
                           <?php } ?>
                           <?php } ?>
                        </span>
                    </div>
                <?php } ?>
                </div>
                <?= $paginator->ellipsisLinks() ?>
            <?php } else { ?>
                <div class="danger p2">
                    <p>No hay libros que mostrar</p>
                </div>
            <?php } ?>
            <div class="centered">
                <?php if(Login::oneRole(LIBRARIAN_PANEL_ROLES)){ ?>
                 <a class="button-success flex1" href="/Libro/create">Nuevo libro</a>
                 <?php } ?>
                <a class="button" onclick="history.back()">Atrás</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>