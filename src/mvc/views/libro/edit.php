<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Editar libro - <?= APP_NAME ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $template->css() ?>
        <script src="/js/Preview.js"></script>
    </head>
    <body>

        <?= $template->header('Editar libro') ?>
        <?= $template->menu() ?>
        <?= $template->breadCrumbs([
            'Libros'=>'/Libro/list',
            'Edición ' . $libro->titulo => null
        ]) ?>
        <?= $template->messages() ?>

        <main>
            <h1><?= APP_NAME?></h1>

            <h2>Editar el libro <?= $libro->titulo ?></h2>

            <form action="/Libro/update" enctype="multipart/form-data" method="POST" class="flex2 no-border">
                <div class="flex2">
                    <input type="hidden" value="<?= $libro->id ?>" name="id">
                    <label>ISBN:</label>
                    <input type="text" name="isbn" value="<?= old('isbn', $libro->isbn)?>">
                    <br>
                    <label>Título:</label>
                    <input type="text" name="titulo" value="<?= old('titulo', $libro->titulo)?>">
                    <br>
                    <label>Editorial:</label>
                    <input type="text" name="editorial" value="<?= old('editorial', $libro->editorial)?>">
                    <br>
                    <label>Autor:</label>
                    <input type="text" name="autor" value="<?= old('autor', $libro->autor)?>">
                    <br>
                    <label>Portada:</label>
                    <input type="file" name="portada" id="file-with-preview" accept="image/*">
                    <br>
                    <label>Idioma:</label>
                    <input type="text" name="idioma" value="<?= old('idioma', $libro->idioma)?>">
                    <br>
                    <label>Edición:</label>
                    <input type="text" name="edicion" value="<?= old('edicion', $libro->edicion)?>">
                    <br>
                    <label>Año:</label>
                    <input type="number" name="anyo" value="<?= old('anyo', $libro->anyo)?>">
                    <br>
                    <label>Edad Rec.:</label>
                    <input type="number" name="edadrecomendada" value="<?= old('edadrecomendada', $libro->edadrecomendada)?>">
                    <br>
                    <label>Páginas:</label>
                    <input type="number" name="paginas" value="<?= old('paginas', $libro->paginas)?>">
                    <br>
                    <label>Característias:</label>
                    <input type="text" name="caracteristicas" value="<?= old('caracteristicas', $libro->caracteristicas)?>">
                    <br>
                    <label>Sinopsis:</label>
                    <textarea name="sinopsis" class="w50" ><?= old('sinopsis')?></textarea>
                    <br>
                    <div class="centered mt2">
                    <input type="submit" class="button" name="actualizar" value="Actualizar">
                    <input type="reset" class="button" value="Reset">
                </div>
            </form>
            <figure class="flex1 centrado">
                <img src="<?= BOOK_IMAGE_FOLDER . '/' .($libro->portada ?? DEFAULT_BOOK_IMAGE) ?>" class="cover" id="preview-image">
                <figcaption>Portada de <?= $libro->titulo ?></figcaption>
            <?php if($libro->portada){ ?>
                <form action="/Libro/dropcover" method="POST" class="no-border">
                    <input type="hidden" name="id" value="<?= $libro->id ?>">
                    <input type="submit" value="Eliminar portada" name="borrar" class="button-danger">
                </form>
            <?php } ?>

            </figure>
            <section>
                <script>
                    function confirmar(id){
                        if(confirm('¿Seguro que desea eliminar?')){
                            location.href='/Ejemplar/destroy/'+id;
                        }
                    }
                </script>
                <h2>Ejemplares de este libro</h2>
                <a class="button" href="/Ejemplar/create/<?= $libro->id ?>">Nuevo ejemplar</a>
                <table class="table w100">
                    <tr>
                        <th>ID</th>
                        <th>Estado</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
            <?php foreach($ejemplares as $ejemplar){?>
                    <tr>
                        <td><?=$ejemplar->id?></td>
                        <td><?=$ejemplar->estado?></td>
                        <td><?=$ejemplar->precio . ' €'?></td>
                        <td>
                            <a class="button" href="/Ejemplar/edit/<?= $ejemplar->id ?>">Editar</a>
                            <?php if(!$ejemplar->hasAny('Prestamo')){ ?>
                                <a class="button" onclick="confirmar(<?= $ejemplar->id?>)">Borrar</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </table>
                </section>
                <section>
                    <h2>Temas de este libro</h2>
                    <form class="w50 m0 no-border" method="POST" action="/Libro/addtema">
                        <input type="hidden" name="idlibro" value="<?= $libro->id ?>">
                        <select name="idtema">
                            <?php foreach($listaTemas as $nuevoTema ){?>
                                <option value="<?= $nuevoTema->id ?>"><?= $nuevoTema->tema ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Añadir Tema" name="add" class="button-success">
                    </form>
                    <table class="table w100">
                        <tr>
                            <th>ID</th>
                            <th>Tema</th>
                            <th>Acciones</th>
                        </tr>
                    <?php foreach($temas as $tema){?>
                        <tr>
                            <td><?=$tema->id?></td>
                            <td>
                                <a href="/Tema/show/<?=$tema->id?>">
                                    <?=$tema->tema?>
                                </a>
                            </td>
                            <td class="centrado">
                                <form action="/Libro/removetema" method="POST" class="no-border">
                                    <input type="hidden" name="idlibro" value="<?= $libro->id ?>">
                                    <input type="hidden" name="idtema" value="<?= $tema->id ?>">
                                    <input type="submit" value="Borrar" name="remove" class="button-danger">
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </section>
                </div>

            <div class="centrado my2">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/libro/list">Lista de libros</a>
                <a class="button" href="/libro/show/<?= $libro->id ?>">Detalles</a>
                <a class="button" href="/libro/delete/<?= $libro->id ?>">Borrar</a>
            </div>
        </main>
        <?= $template->footer() ?>
    </body>
</html>