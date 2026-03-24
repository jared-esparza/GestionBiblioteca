<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lista de temas - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>
        
        <?= $template->header('Lista de temas') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs(['Temas'=>null]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>
            <h2>Lista completa de temas</h2>

            <div class="right">
                <?= $paginator->stats() ?>
            </div>
            <?php if($temas){ ?>
                <table class="table w100">
                    <tr>
                        <th>Tema</th>
                        <th>Descripcion</th>
                        <th class="centrado">Operaciones</th>
                    </tr>
                <?php foreach($temas as $tema){ ?>
                    <tr>
                        <td><?= $tema->tema ?></td>
                        <td><?= $tema->descripcion ?></td>
                        <td class="centrado">
                            <a href="/Tema/show/<?= $tema->id ?>">Ver</a>
                            <a href="/Tema/edit/<?= $tema->id ?>">Editar</a>
                            <a href="/Tema/delete/<?= $tema->id ?>">Borrar</a>
                        </td>
                    </tr>
                <?php } ?>
                </table>
                <?= $paginator->ellipsisLinks() ?>
            <?php } else { ?>
                <div class="danger p2">
                    <p>No hay temas que mostrar</p>
                </div>
            <?php } ?>
            <div class="centered">
                <a class="button-success" href="/Tema/create">Nuevo tema</a>
                <a class="button" onclick="history.back()">Atrás</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>