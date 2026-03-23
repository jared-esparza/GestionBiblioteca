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
            <h1><?= APP_NAME?></h1>
            <h2>Lista completa de socios</h2>

            <a class="button" href="/Socio/create">Nuevo socio</a>

            <?php if($socios){ ?>
                <table class="table w100">
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Poblacion</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th class="centrado">Operaciones</th>
                    </tr>
                <?php foreach($socios as $socio){ ?>
                    <tr>
                        <td><?= $socio->dni ?></td>
                        <td><?= $socio->nombre ?></td>
                        <td><?= $socio->poblacion ?></td>
                        <td><?= $socio->telefono ?></td>
                        <td><?= $socio->email ?></td>

                        <td class="centrado">
                            <a href="/Socio/show/<?= $socio->id ?>">Ver</a>
                            <a href="/Socio/edit/<?= $socio->id ?>">Editar</a>
                            <a href="/Socio/delete/<?= $socio->id ?>">Borrar</a>
                        </td>
                    </tr>
                <?php } ?>
                </table>
            <?php } else { ?>
                <div class="danger p2">
                    <p>No hay socios que mostrar</p>
                </div>
            <?php } ?>
            <div class="centered">
                <a class="button" onclick="history.back()">Atrás</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>