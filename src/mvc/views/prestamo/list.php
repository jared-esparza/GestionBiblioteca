<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lista de prestamos - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>

        <?= $template->header('Lista de prestamos') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs(['Prestamos'=>null]) ?>
        <?= $template->messages() ?>

        <main>
            <h2>Lista completa de prestamos</h2>
            <br>
            <?php
                echo $template->filter(
                    // opciones para el desplegable "buscar en"
                    [
                        'Título' => 'titulo',
                        'Nombre' => 'nombre',
                        'Apellidos' => 'apellidos',
                    ],
                    // opciones para el desplegable "ordenar por"
                    [
                        'Fecha' => 'prestamo',
                        'Límite' => 'limite',
                        'Devolución' => 'devolucion',
                        'Título' => 'titulo'
                    ],
                    'Tiítulo', // opción seleccionada por defecto en "buscar en"
                    'Fecha', // opción seleccionada por defecto en "ordenar por"
                    $filtro  // filtro aplicado (null si no hay) - viene del controlador
                );?>
            <div class="right">
                <?= $paginator->stats() ?>
            </div>
            <?php if($prestamos){ ?>
                <table class="table w100">
                    <tr>
                        <th>ID</th>
                        <th>Socio</th>
                        <th>Ejemplar</th>
                        <th>Titulo</th>
                        <th>Limite</th>
                        <th>Devolucion</th>
                        <th class="centrado">Acciones</th>
                    </tr>
                <?php foreach($prestamos as $prestamo){ ?>
                    <tr>
                        <td><?= $prestamo->id ?></td>
                        <td>
                            <a href="/Socio/show/<?= $prestamo->idsocio ?>">
                                <?= $prestamo->nombre . ' ' . $prestamo->apellidos ?>
                            </a>
                        </td>
                        <td><?= $prestamo->idejemplar ?></td>
                        <td>
                            <a href="/Libro/show/<?= $prestamo->idlibro ?>">
                                <?= $prestamo->titulo ?>
                            </a>
                        </td>
                        <td><?= $prestamo->limite ?></td>
                        <td><?= $prestamo->devolucion ?></td>
                        <td>
                        <?php if(!$prestamo->devolucion){ ?>
                            <a class="button-success" href="/Prestamo/returndate/<?= $prestamo->id ?>">Devolucion</a>
                            <a class="button" href="/Prestamo/extend/<?= $prestamo->id ?>">Ampliar</a>
                           <?php } ?>

                            <a class="button-warning" href="/Prestamo/issue/<?= $prestamo->id ?>">Incidencia</a>
                            <a class="button-danger" href="/Prestamo/delete/<?= $prestamo->id ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
                </table>
                <?= $paginator->ellipsisLinks() ?>
            <?php } else { ?>
                <div class="danger p2">
                    <p>No hay prestamos que mostrar</p>
                </div>
            <?php } ?>
            <div class="centered">
                <a class="button-success" href="/Prestamo/create">Nuevo prestamo</a>
                <a class="button" onclick="history.back()">Atrás</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>