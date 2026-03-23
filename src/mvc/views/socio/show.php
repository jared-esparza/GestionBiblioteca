<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Detalles de socio - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>
        
        <?= $template->header('Detalles de socio') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Socios'=>'/Socio/list',
            'Detalles de ' . $socio->nombre => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>
            <section>
                <h2><?= $socio->dni . ' ' . $socio->nombre ?></h2>
                <p><b>DNI:</b> <?= $socio->dni ?></p>
                <p><b>Nombre:</b> <?= $socio->nombre ?></p>
                <p><b>Apellidos:</b> <?= $socio->apellidos ?></p>
                <p><b>Nacimiento:</b> <?= $socio->nacimiento ?></p>
                <p><b>Email:</b> <?= $socio->email ?></p>
                <p><b>Dirección:</b> <?= $socio->direccion ?></p>
                <p><b>CP:</b> <?= $socio->cp ?></p>
                <p><b>Población:</b> <?= $socio->poblacion ?></p>
                <p><b>Provincia:</b> <?= $socio->provincia ?></p>
                <p><b>Telefono:</b> <?= $socio->telefono ?></p>

                <h2>Lista de prestamos</h2>
                <a class="button" href="/Prestamo/create/<?= $socio->id ?>">Nuevo prestamo</a>
                <table class="table w100">
                    <tr>
                        <th>Libro</th>
                        <th>Prestamo</th>
                        <th>Limite</th>
                        <th>Devolucion</th>
                        <th>Incidencia</th>
                    </tr>
                <?php
                    foreach($prestamos as $prestamo){?>
                    <tr>
                        <td><?=$prestamo->titulo?></td>
                        <td><?=$prestamo->prestamo?></td>
                        <td><?=$prestamo->limite?></td>
                        <td><?=$prestamo->devolucion?></td>
                        <td><?=$prestamo->incidencia?></td>
                    </tr>
                    <?php } ?>
                </table>
            </section>
            <div class="centrado">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/Socio/list">Lista de socios</a>
                <a class="button" href="/Socio/edit/<?=$socio->id?>">Editar</a>
                <a class="button" href="/Socio/delete/<?=$socio->id?>">Eliminar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>