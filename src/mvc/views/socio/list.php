<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lista de socios - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>

        <?= $template->header('Lista de socios') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs(['Socios'=>null]) ?>
        <?= $template->messages() ?>

        <main>
            <h2>Lista completa de socios</h2>
            <br>
            <?php
                echo $template->filter(
                    // opciones para el desplegable "buscar en"
                    [
                        'DNI' => 'titulo',
                        'Nombre' => 'nombre',
                        'Apellidos' => 'apellidos',
                        'Dirección'=> 'direccion',
                        'Población'=> 'poblacion',
                        'Código Postal'=> 'cp',
                        'Provincia'=> 'provincia',
                        'Teléfono'=> 'telefono',
                        'Email'=> 'email'
                    ],
                    // opciones para el desplegable "ordenar por"
                    [
                        'DNI' => 'titulo',
                        'Nombre' => 'nombre',
                        'Apellidos' => 'apellidos',
                        'Dirección'=> 'direccion',
                        'Población'=> 'poblacion',
                        'Código Postal'=> 'cp',
                        'Provincia'=> 'provincia',
                        'Teléfono'=> 'telefono',
                        'Email'=> 'email'
                    ],
                    'Nombre', // opción seleccionada por defecto en "buscar en"
                    'Nombre', // opción seleccionada por defecto en "ordenar por"
                    $filtro  // filtro aplicado (null si no hay) - viene del controlador
                );?>
            <div class="right">
                <?= $paginator->stats() ?>
            </div>
            <?php if($socios){ ?>
                <div class="grid-list">
                    <div class="grid-list-header">
                        <span>DNI</span>
                        <span>Nombre</span>
                        <span>Poblacion</span>
                        <span>Telefono</span>
                        <span>Email</span>
                        <span class="centrado">Operaciones</span>
                    </div>
                <?php foreach($socios as $socio){ ?>
                    <div class="grid-list-item">
                        <span data-label="DNI"><?= $socio->dni ?></span>
                        <span data-label="Nombre"><?= $socio->nombre ?></span>
                        <span data-label="Población"><?= $socio->poblacion ?></span>
                        <span data-label="Teléfono"><?= $socio->telefono ?></span>
                        <span data-label="Email"><?= $socio->email ?></span>

                        <span data-label="Operaciones" class="centrado">
                            <a href="/Socio/show/<?= $socio->id ?>">Ver</a>
                            <a href="/Socio/edit/<?= $socio->id ?>">Editar</a>
                            <a href="/Socio/delete/<?= $socio->id ?>">Borrar</a>
                        </span>
                    </div>
                <?php } ?>
                </div>
                <?= $paginator->ellipsisLinks() ?>
            <?php } else { ?>
                <div class="danger p2">
                    <p>No hay socios que mostrar</p>
                </div>
            <?php } ?>
            <div class="centered">
                <a class="button-success" href="/Socio/create">Nuevo socio</a>
                <a class="button" onclick="history.back()">Atrás</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>