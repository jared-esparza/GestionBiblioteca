<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Editar socio - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
    </head>
    <body>

        <?= $template->header('Lista de socios') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Socios'=>'/Socio/list',
            'Editar ' . $socio->nombre => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>

            <h2>Editar el socio <?= $socio->nombre ?></h2>

            <form action="/Socio/update" enctype="multipart/form-data" method="POST">
                <div class="flex2">
                    <input type="hidden" value="<?= $socio->id ?>" name="id">
                          <label>DNI:</label>
                    <input type="text" name="dni" value="<?= old('dni', $socio->dni)?>">
                    <br>
                    <label>Nombre:</label>
                    <input type="text" name="nombre" value="<?= old('nombre', $socio->nombre)?>">
                    <br>
                    <label>Apellidos:</label>
                    <input type="text" name="apellidos" value="<?= old('apellidos', $socio->apellidos)?>">
                    <br>
                    <label>Nacimiento:</label>
                    <input type="text" name="nacimiento" value="<?= old('nacimiento', $socio->nacimiento)?>">
                    <br>
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= old('email', $socio->email)?>">
                    <br>
                    <label>Dirección:</label>
                    <input type="text" name="direccion" value="<?= old('direccion', $socio->direccion)?>">
                    <br>
                    <label>CP:</label>
                    <input type="text" name="cp" value="<?= old('cp', $socio->cp)?>">
                    <br>
                    <label>Población:</label>
                    <input type="text" name="poblacion" value="<?= old('poblacion', $socio->poblacion)?>">
                    <br>
                    <label>Provincia:</label>
                    <input type="text" name="provincia" value="<?= old('provincia', $socio->provincia)?>">
                    <br>
                    <label>Telefono:</label>
                    <input type="text" name="telefono" value="<?= old('telefono', $socio->telefono)?>">
                </div>
                <div class="centered mt2">
                    <input type="submit" class="button" name="actualizar" value="Actualizar">
                    <input type="reset" class="button" value="Reset">
                </div>

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
                        <td><?= $prestamo->titulo ?></td>
                        <td><?= $prestamo->prestamo ?></td>
                        <td><?= $prestamo->limite ?></td>
                        <td><?= $prestamo->devolucion ?></td>
                        <td><?= $prestamo->incidencia ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </form>
            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/socio/list">Lista de socios</a>
                <a class="button" href="/socio/show/<?= $socio->id ?>">Detalles</a>
                <a class="button" href="/socio/delete/<?= $socio->id ?>">Borrar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>